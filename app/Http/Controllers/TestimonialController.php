<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();

        return view('dashboard.testimonials.index' , ['testimonials'=> $testimonials]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       

        $validation = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
        ]);

        if (!auth()->check()) {
            // Store a session variable to remember that the user came from the testimonial form
            session(['from_testimonial' => true]);
        
            // Redirect back with the error message and input data
            return redirect()->back()->with('error', 'Please log in to submit your feedback.')->withInput();
        }

        Testimonial::create([
            'message'=>$request->input('message'),
            'rating'=>$request->input('rating'),
            'user_id'=>auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Thank you for sharing your feedback');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return view('dashboard.testimonials.show' , ['testimonial'=> $testimonial]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete(); 
        
        return to_route('testimonials.index')->with('success', 'Feedback deleted');
    }
}
