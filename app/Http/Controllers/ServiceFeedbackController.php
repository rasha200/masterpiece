<?php

namespace App\Http\Controllers;

use App\Models\ServiceFeedback;
use App\Models\Service;
use App\Models\Appointment;


use Illuminate\Http\Request;

class ServiceFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($service_id)
    {
       
        $serviceFeedbacks = ServiceFeedback::where('service_id', $service_id)->orderBy('created_at', 'desc')->paginate(10);
        
       
        $service = Service::findOrFail($service_id); 
        
        
        return view('dashboard.service_feedbacks.index', [
            'serviceFeedbacks' => $serviceFeedbacks,
            'service_id' => $service_id,
            'service_name' => $service->name, 
        ]);
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
       
        $userId = auth()->id();
        $serviceId = $request->service_id;
    
        // Check if the user has a completed or accepted appointment for the service
        $appointmentExists = Appointment::where('user_id', $userId)
                                         ->where('service_id', $serviceId)
                                         ->whereIn('status', ['Accept']) // Adjust status conditions
                                         ->exists();
    
        if (!$appointmentExists) {
            return redirect()->back()->with('not_allow', 'You can only add a review for services you have booked and completed');
        }
        

        $validation = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string',
        ]);

        if (!auth()->check()) {
            // Store a session variable to remember that the user came from the service feedback form
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
    public function show($service_id, ServiceFeedback $serviceFeedback)
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
        $validation = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string',
        ]);

      $serviceFeedback->update ([
            'rating'=>$request->input('rating'),
            'feedback'=>$request->input('feedback'),
            'user_id'=>auth()->id(),
            'service_id'=>$request->input('service_id'),
        ]);
        return redirect()->back()->with('success', 'Thank you for updating your reviwe');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceFeedback $serviceFeedback)
    {

        $service_id = $serviceFeedback->service_id; // Get the service_id from the serviceFeedback

        $serviceFeedback->delete(); 
        
        return to_route('serviceFeedbacks.index', ['service_id' => $service_id])->with('success', 'Review deleted');
    }


   
}
