<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::all();

        return view('dashboard.pets.index' , ['pets'=> $pets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('dashboard.pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'gender' => 'required|string',
            'type' => 'required|string',
            'information' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/pet/');
            $file->move($path, $filename);
        }

        Pet::create([
            'name'=>$request->input('name'),
            'age'=>$request->input('age'),
            'gender'=>$request->input('gender'),
            'type'=>$request->input('type'),
            'information'=>$request->input('information'),
            'image'=>$filename,
        ]);

       

        return to_route('pets.index')->with('success', 'Pet created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        return view('dashboard.pets.show' , ['pet'=> $pet]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        return view ('dashboard.pets.edit' , ['pet' => $pet]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $validation = $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'gender' => 'required|string',
            'type' => 'required|string',
            'information' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

       
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/pet/');
            $file->move($path, $filename);
        } 
        else {
        $filename = $pet->image; 
    }

        $pet->update([
            'name'=>$request->input('name'),
            'age'=>$request->input('age'),
            'gender'=>$request->input('gender'),
            'type'=>$request->input('type'),
            'information'=>$request->input('information'),
            'image'=>$filename,
        ]);

       

        return to_route('pets.index')->with('success', 'Pet updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        $pet->delete(); 
        
        return to_route('pets.index')->with('success', 'pet deleted');
    }
}
