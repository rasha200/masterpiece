<?php

namespace App\Http\Controllers;

use App\Models\ServiceFeedback;
use Illuminate\Http\Request;

class ServiceFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceFeedbacks = ServiceFeedback::all();

        return view('dashboard.service_feedbacks.index' , ['serviceFeedbacks'=> $serviceFeedbacks]);
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
            'feedback' => 'required|string',
        ]);

        if (!auth()->check()) {
            // Store a session variable to remember that the user came from the testimonial form
            session(['from_serviceFeedback' => true, 'service_id' => $request->input('service_id')]);
        
            // Redirect back with the error message and input data
            return redirect()->back()->with('error', 'Please log in to submit your reviwe.')->withInput();
        }

        ServiceFeedback::create([
            'rating'=>$request->input('rating'),
            'feedback'=>$request->input('feedback'),
            'user_id'=>auth()->id(),
            'service_id'=>$request->input('service_id'),
        ]);

        return redirect()->back()->with('success', 'Thank you for sharing your reviwe');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceFeedback $serviceFeedback)
    {
        return view('dashboard.service_feedbacks.show' , ['serviceFeedback'=> $serviceFeedback]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceFeedback $serviceFeedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceFeedback $serviceFeedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceFeedback $serviceFeedback)
    {
        $serviceFeedback->delete(); 
        
        return to_route('serviceFeedbacks.index')->with('success', 'Review deleted');
    }
}
