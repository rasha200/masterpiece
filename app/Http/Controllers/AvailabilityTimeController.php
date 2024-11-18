<?php

namespace App\Http\Controllers;

use App\Models\AvailabilityTime;
use App\Models\Service;

use Illuminate\Http\Request;

class AvailabilityTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($service_id)
    {
        // Map days to a custom order, starting from Friday
        $dayOrder = [
            'Friday' => 0,
            'Saturday' => 1,
            'Sunday' => 2,
            'Monday' => 3,
            'Tuesday' => 4,
            'Wednesday' => 5,
            'Thursday' => 6,
        ];
    
        // Retrieve and sort availability times
        $AvailabilityTimes = AvailabilityTime::where('service_id', $service_id)
            ->get()
            ->sortBy(function ($availabilityTime) use ($dayOrder) {
                return $dayOrder[$availabilityTime->day_of_week] ?? 7; // Default to last if day not mapped
            });
    
        $service = Service::findOrFail($service_id);
    
        return view('dashboard.availability_times.index', [
            'AvailabilityTimes' => $AvailabilityTimes,
            'service_id' => $service_id,
            'service_name' => $service->name,
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create($service_id)
    {
        $service = Service::findOrFail($service_id); 

        return view('dashboard.availability_times.create' , [
            'service_name' => $service->name, 
            'service' => $service, 
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Retrieve the average time for the selected service
    $service = Service::find($request->input('service_id'));
    $averageTime = $service->average_time; // Duration in minutes

    // Parse the start and end times
    $startTime = \Carbon\Carbon::createFromTimeString($request->input('start_time'));
    $endTime = \Carbon\Carbon::createFromTimeString($request->input('end_time'));

    // Loop to calculate and store individual slots
    $currentSlotStart = $startTime;

    while ($currentSlotStart < $endTime) {
        $currentSlotEnd = $currentSlotStart->copy()->addMinutes($averageTime);

        // Ensure the end time of the slot doesn't exceed the given end_time
        if ($currentSlotEnd > $endTime) {
            break;
        }



        AvailabilityTime::create([
            'day_of_week'=>$request->input('day_of_week'),
            'start_time'=>$currentSlotStart->format('H:i'),
            'end_time'=>$currentSlotEnd->format('H:i'),
            'service_id'=>$request->input('service_id'),
            'is_available'=>$request->input('is_available'),
        ]);
          // Move to the next slot
          $currentSlotStart = $currentSlotEnd;
        }

        return to_route('availabilityTimes.index', ['service_id' => $request->input('service_id')])
        ->with('success', 'Service availability Time created successfully');   
     }
    

    /**
     * Display the specified resource.
     */
    public function show( AvailabilityTime $availabilityTime)
    {
       //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($service_id, AvailabilityTime $availabilityTime)
    {
        $service = Service::findOrFail($service_id); 
        return view('dashboard.availability_times.edit', [
            'availabilityTime'=> $availabilityTime,
            'service_name' => $service->name,
            'service' => $service,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AvailabilityTime $availabilityTime)
    {
        $validation = $request->validate([
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
        

      $availabilityTime->update ([
           'day_of_week'=>$request->input('day_of_week'),
           'start_time'=>$request->input('start_time'),
           'end_time'=>$request->input('end_time'),
           'service_id'=>$request->input('service_id'),
        ]);

        return to_route('availabilityTimes.index', ['service_id' => $request->input('service_id')])
        ->with('success', 'Service availability Time updated successfully');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($service_id, AvailabilityTime $availabilityTime)
    {
        $service_id = $availabilityTime->service_id; // Get the service_id from the availabilityTime

        $availabilityTime->delete(); 
        
        return to_route('availabilityTimes.index', ['service_id' => $service_id])->with('success', 'Service availability Time deleted');

    }
}
