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
        $AvailabilityTimes = AvailabilityTime::where('service_id', $service_id)->get();
        
       
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

        AvailabilityTime::create([
            'day_of_week'=>$request->input('day_of_week'),
            'start_time'=>$request->input('start_time'),
            'end_time'=>$request->input('end_time'),
            'service_id'=>$request->input('service_id'),
        ]);

        return to_route('availabilityTimes.index', ['service_id' => $request->input('service_id')])
        ->with('success', 'Service availability Time created successfully');    }

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
