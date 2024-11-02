<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceImage;

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
            'price' => 'nullable',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,WEBP|max:2048',
        ]);

        $service = Service::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'small_description'=>$request->input('small_description'),
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



    public function show_user_side( $id)
    {
        $service = Service::findOrFail($id); 
        $serviceImages = $service->service_images; 
        $servicefeedbacks = $service->service_feedbacks; 
        return view('service_details' , ['service'=> $service,'serviceImages'=>$serviceImages,'servicefeedbacks'=>$servicefeedbacks]);
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
            'price' => 'nullable',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $service->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'small_description'=>$request->input('small_description'),
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
