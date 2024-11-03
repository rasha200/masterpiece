<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\PetImage;

use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::with('pet_images')->get();

        return view('dashboard.pets.index' , ['pets'=> $pets]);
    }

    public function index_user_side()
    {
        $pets = Pet::with('pet_images')->get();

        return view('pet_adoption' , ['pets'=> $pets]);
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
            'pet_vaccinations_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Special_needs' => 'nullable|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,WEBP,AVIF|max:2048',
        ]);

        $filename = null;
        if ($request->hasFile('pet_vaccinations_image')) {
            $file = $request->file('pet_vaccinations_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/pet/');
            $file->move($path, $filename);
        }

        $pet = Pet::create([
            'name'=>$request->input('name'),
            'age'=>$request->input('age'),
            'gender'=>$request->input('gender'),
            'type'=>$request->input('type'),
            'information'=>$request->input('information'),
            'pet_vaccinations_image'=>$filename,
            'Special_needs'=>$request->input('Special_needs'),
        ]);


        $images = [];

        if ($request->hasFile('image')) {
            foreach($request->file('image') as $file) {
               
                $filename = uniqid() . '_' . $file->getClientOriginalExtension();
                $path = public_path('uploads/pet/');
                $file->move($path, $filename);
    
               
                $images[] = [
                    'image' => 'uploads/pet/' . $filename,
                    'pet_id'=> $pet->id, 
                ];
            }
    
            
            PetImage::insert($images);
        }

       

        return to_route('pets.index')->with('success', 'Pet created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        $petImages = $pet->pet_images; 
        return view('dashboard.pets.show' , ['pet'=> $pet,'petImages'=>$petImages]);
    }




    public function show_user_side($id)
    {
        $pet = Pet::findOrFail($id); 
        $petImages = $pet->pet_images; 
        return view('pet_details' , ['pet'=> $pet,'petImages'=>$petImages]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        $petImages = $pet->pet_images; 
        return view ('dashboard.pets.edit' , ['pet' => $pet,'petImages'=>$petImages]);
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
            'pet_vaccinations_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,WEBP|max:2048',
            'Special_needs' => 'nullable|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,WEBP,AVIF|max:2048',
        ]);

       
        if ($request->hasFile('pet_vaccinations_image')) {
            $file = $request->file('pet_vaccinations_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/pet/');
            $file->move($path, $filename);
        } 
        else {
        $filename = $pet->pet_vaccinations_image; 
    }

        $pet->update([
            'name'=>$request->input('name'),
            'age'=>$request->input('age'),
            'gender'=>$request->input('gender'),
            'type'=>$request->input('type'),
            'information'=>$request->input('information'),
            'pet_vaccinations_image'=>$filename,
            'Special_needs'=>$request->input('Special_needs'),
        ]);

        $images = [];

        if ($request->hasFile('image')) {
            foreach($request->file('image') as $file) {
               
                $filename = uniqid() . '_' . $file->getClientOriginalExtension();
                $path = public_path('uploads/pet/');
                $file->move($path, $filename);
    
               
                $images[] = [
                    'image' => 'uploads/pet/' . $filename,
                    'pet_id'=> $pet->id, 
                ];
            }
    
            
            PetImage::insert($images);
        }
       

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
