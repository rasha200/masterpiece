<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AvailabilityTime;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::paginate(10); 
      
        return view('dashboard.appointments.index' , ['appointments'=> $appointments]);

    }

    public function veterinarian_schedule()
{
    // Get today's date in the format 'Y-m-d'
    $today = \Carbon\Carbon::today()->format('Y-m-d');

    // Fetch appointments where the 'day' column contains today's date
    $appointments = Appointment::where('status', 'Accept')
        ->get()
        ->filter(function ($appointment) use ($today) {
            // Extract the date part from the 'day' column (e.g., "Monday 2024-11-18" -> "2024-11-18")
            $appointmentDate = \Carbon\Carbon::parse($appointment->day)->format('Y-m-d');
            return $appointmentDate === $today;  // Compare the date part
        });

    // Add a formatted duration for each appointment
    foreach ($appointments as $appointment) {
        $averageTime = $appointment->service->average_time;
        $petNumber = $appointment->pet_number;

        // Calculate total time in minutes
        $totalMinutes = $averageTime * $petNumber;

        // Calculate hours and minutes
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        // Format duration as "Xh Ym"
        $appointment->formattedDuration = ($hours > 0 ? $hours . 'h ' : '') . $minutes . 'm';
    }

    return view('dashboard.appointments.veterinarian_schedule', [
        'appointments' => $appointments,
    ]);
}

    
    

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



public function store(Request $request)
{


    // Validate the request
    $request->validate([
        'appointment_datetime' => 'required|date_format:Y-m-d h:i A',
        'pet_number' => 'required|integer|min:1',
        'service_id' => 'required|exists:services,id',
    ]);

    // Retrieve the service
    $service = Service::findOrFail($request->input('service_id'));
    $averageTimePerPet = $service->average_time; // Average time in minutes per pet

    // Calculate appointment times
    $startTime = Carbon::createFromFormat('Y-m-d h:i A', $request->input('appointment_datetime'));
    $totalDuration = $averageTimePerPet * $request->input('pet_number'); // Total time for all pets
    $endTime = $startTime->copy()->addMinutes($totalDuration);

    // Check for slot availability
    $isSlotAvailable = AvailabilityTime::where('service_id', $request->input('service_id'))
        ->where('is_available', 'true')
        ->where(function ($query) use ($startTime, $endTime) {
            $query->where(function ($q) use ($startTime, $endTime) {
                $q->whereTime('start_time', '<=', $startTime->format('H:i:s'))
                  ->whereTime('end_time', '>', $startTime->format('H:i:s'));
            })->orWhere(function ($q) use ($startTime, $endTime) {
                $q->whereTime('start_time', '<', $endTime->format('H:i:s'))
                  ->whereTime('end_time', '>=', $endTime->format('H:i:s'));
            });
        })
        ->exists();

    if (!$isSlotAvailable) {
        return redirect()->back()->with('error', 'The selected slot is not available. Please choose another slot.');
    }

    // Create the appointment
    $appointment = Appointment::create([
        'day' => $startTime->format('l') . ' ' . $startTime->format('Y-m-d'), 
        'start_time' => $startTime->format('H:i'),
        'end_time' => $endTime->format('H:i'),
        'status' => 'Pending', // Default status
        'pet_number' => $request->input('pet_number'),
        'user_id' => auth()->id(), // Authenticated user ID
        'service_id' => $request->input('service_id'),
    ]);

    // Mark overlapping slots as unavailable
    AvailabilityTime::where('service_id', $request->input('service_id'))
        ->where('is_available', 'true')
        ->where(function ($query) use ($startTime, $endTime) {
            $query->whereTime('start_time', '>=', $startTime->format('H:i:s'))
                  ->whereTime('start_time', '<', $endTime->format('H:i:s'));
        })
        ->update(['is_available' => 'false']);

    return redirect()->back()->with('success', 'Thank you for booking this appointment.');
}


    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {

         $averageTime = $appointment->service->average_time;
         $petNumber = $appointment->pet_number;
         $totalMinutes = $averageTime * $petNumber;

        // Calculate hours and minutes
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        // Format duration
         $formattedDuration = ($hours > 0 ? $hours . 'h ' : '') . $minutes . 'm';

        return view('dashboard.appointments.show' , ['appointment'=> $appointment, 'formattedDuration'=> $formattedDuration]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validation = $request->validate([
            'status' => 'required|in:Accept,Reject',
        ]);

        $appointment->update([
            'status' => $request->input('status'),
        ]);
        
        return redirect()->route('appointments.index')->with('success', 'Appointment request updated successfully');

 
    }


    public function update_userside(Request $request, Appointment $appointment)
    {
        $validation = $request->validate([
            'status' => 'required|in:Cancelled',
        ]);

        $appointment->update([
            'status' => $request->input('status'),
        ]);

         // Update availability times to true when appointment is cancelled
    $availabilityTimes = AvailabilityTime::where('service_id', $appointment->service_id)
    ->where('is_available', 'false') // Make sure we're updating only unavailable times
    ->where(function ($query) use ($appointment) {
        // Adjust the query to match the time of the cancelled appointment
        $query->whereTime('start_time', '>=', $appointment->start_time)
              ->whereTime('end_time', '<=', $appointment->end_time);
    })
    ->update(['is_available' => 'true']);

        

        return redirect()->back()->with('success', 'Appointment cancelled successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
