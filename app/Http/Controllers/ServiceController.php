<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('dashboard.services.index' , ['services'=> $services]);
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
            'description' => 'required|string',
        ]);

        Service::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
        ]);

       

        return to_route('services.index')->with('success', 'Service created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('dashboard.services.show' , ['service'=> $service]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view ('dashboard.services.edit' , ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        
        $validation = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $service->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
        ]);

       

        return to_route('services.index')->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete(); 
        
        return to_route('services.index')->with('success', 'Service deleted successfully');
    }
}
