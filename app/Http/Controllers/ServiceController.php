<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\AvailabilityTime;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('service_images')->get(); 
        return view('dashboard.services.index' , ['services'=> $services]);
    }

    

    public function index_user_side()
    {
        $services = Service::with('service_images')->get();
        foreach ($services as $service) {
            $service->averageRating = $service->service_feedbacks()->avg('rating') ?? 0;
        }
        return view('services' , ['services'=> $services]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('dashboard.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'description' => 'required',
            'small_description' => 'required|string',
            'average_time' => 'required|integer',
            'price' => 'nullable|integer',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,WEBP|max:2048',
        ]);

        $service = Service::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'small_description'=>$request->input('small_description'),
            'average_time'=>$request->input('average_time'),
            'price'=>$request->input('price'),
        ]);

        $images = [];

        if ($request->hasFile('image')) {
            foreach($request->file('image') as $file) {
               
                $filename = uniqid() . '_' . $file->getClientOriginalExtension();
                $path = public_path('uploads/service/');
                $file->move($path, $filename);
    
               
                $images[] = [
                    'image' => 'uploads/service/' . $filename,
                    'service_id'=> $service->id, 
                ];
            }
    
            
            ServiceImage::insert($images);
        }
       

        return to_route('services.index')->with('success', 'Service created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $serviceImages = $service->service_images; 
        
        return view('dashboard.services.show' , ['service'=> $service,'serviceImages'=>$serviceImages]);
    }



    public function show_user_side(Request $request, $id)
    {
        $service = Service::findOrFail($id); 
        $serviceImages = $service->service_images; 
        $averageRating = $service->service_feedbacks()->avg('rating') ?? 0;
        $servicefeedbacks = $service->service_feedbacks()->orderBy('created_at', 'desc')->get();
    
        // Get the date from the request, default to today's date if not provided
        $date = $request->query('date', now()->format('Y-m-d')); 
        $dayOfWeek = Carbon::parse($date)->format('l'); 
    
        // Fetch pre-slotted availability times for the selected day that are still available
        $availableSlots = AvailabilityTime::where('service_id', $id)
            ->where('day_of_week', $dayOfWeek)
            ->where('is_available', true)
            ->get(['id', 'start_time', 'end_time']); // Fetch only relevant columns
    
        // Prepare slots for display
        $timeSlots = [];
        foreach ($availableSlots as $slot) {
            $timeSlots[] = [
                'start_time' => Carbon::parse($slot->start_time)->format('h:i A'),
                'end_time' => Carbon::parse($slot->end_time)->format('h:i A'),
                'availability_time_id' => $slot->id,
            ];
        }
    
        return view('service_details', [
            'service' => $service,
            'serviceImages' => $serviceImages,
            'averageRating' => $averageRating,
            'servicefeedbacks' => $servicefeedbacks,
            'timeSlots' => $timeSlots,
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $serviceImages = $service->service_images; 
        return view ('dashboard.services.edit' , ['service' => $service ,'serviceImages'=>$serviceImages]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
       
        
        $validation = $request->validate([
            'name' => 'required|string',
            'description' => 'required',
            'small_description' => 'required|string',
            'average_time' => 'required|integer',
            'price' => 'nullable|integer',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $service->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'small_description'=>$request->input('small_description'),
            'average_time'=>$request->input('average_time'),
            'price'=>$request->input('price'),
        ]);

        
        $images = [];

        if ($request->hasFile('image')) {
            foreach($request->file('image') as $file) {
               
                $filename = uniqid() . '_' . $file->getClientOriginalExtension();
                $path = public_path('uploads/service/');
                $file->move($path, $filename);
    
               
                $images[] = [
                    'image' => 'uploads/service/' . $filename,
                    'service_id'=> $service->id, 
                ];
            }
    
            
            ServiceImage::insert($images);
        }
       

       

        return to_route('services.index')->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete(); 
        
        return to_route('services.index')->with('success', 'Service deleted');
    }
}
