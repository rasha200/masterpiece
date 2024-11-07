<?php

namespace App\Http\Controllers;

use App\Models\ToAdoupt;
use App\Models\Pet;

use Illuminate\Http\Request;

class ToAdouptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ToAdoupts = ToAdoupt::all(); 
      
        return view('dashboard.ToAdoupts.index' , ['ToAdoupts'=> $ToAdoupts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($pet_id)
    {
        $pet = Pet::with('pet_images')->findOrFail($pet_id); // Fetch the Pet model with images

        return view('adoption_request', ['pet'=> $pet]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validation = $request->validate([
            'reason_for_adoption' => 'required|string',
            'current_pets' => 'required|string',
            'availability' => 'required|string',
            'pet_experience' => 'required|string',
            'contact_info' => 'required|string',
            'address' => 'required|string',
        ]);

        if (!auth()->check()) {
            // Store a session variable to remember that the user came from the adoption_request form
            session(['from_adoption' => true ,'pet_id' => $request->input('pet_id')]);
        
            // Redirect back with the error message and input data
            return redirect()->back()->with('error', 'Please log in to submit your adoption request')->withInput();
        }

        ToAdoupt::create([
            'reason_for_adoption'=>$request->input('reason_for_adoption'),
            'status'=>$request->input('status'),
            'current_pets'=>$request->input('current_pets'),
            'availability'=>$request->input('availability'),
            'pet_experience'=>$request->input('pet_experience'),
            'contact_info'=>$request->input('contact_info'),
            'address'=>$request->input('address'),
            'pet_id'=>$request->input('pet_id'),
            'user_id'=>auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Thank you for submitting your adoption request');
    }

    /**
     * Display the specified resource.
     */
    public function show(ToAdoupt $toAdoupt)
    {
        return view('dashboard.ToAdoupts.show' , ['toAdoupt'=> $toAdoupt]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ToAdoupt $toAdoupt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ToAdoupt $toAdoupt)
    {
        $validation = $request->validate([
            'status' => 'required|in:Accept,Reject',
        ]);

        $toAdoupt->update([
            'status' => $request->input('status'),
        ]);

        return redirect()->back()->with('success', 'Adoption request updated successfully');
    }



    public function update_userside(Request $request, ToAdoupt $toadoupt)
    {
        $validation = $request->validate([
            'status' => 'required|in:Cancelled',
        ]);

        $toadoupt->update([
            'status' => $request->input('status'),
        ]);

        return redirect()->back()->with('success', 'Adoption request cancelled successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ToAdoupt $toAdoupt)
    {
       
    }
}
