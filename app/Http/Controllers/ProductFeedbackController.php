<?php

namespace App\Http\Controllers;

use App\Models\ProductFeedback;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($product_id)
    {
        $productfeedbacks = ProductFeedback::where('product_id', $product_id)->orderBy('created_at', 'desc')->paginate(10);
        $product = Product::findOrFail($product_id);


        return view('dashboard.product_feedbacks.index' , [
            'productfeedbacks'=> $productfeedbacks,
            'product_id'=> $product_id,
            'product_name' => $product->name, 
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
        $validation = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string',
        ]);

        if (!auth()->check()) {
            // Store a session variable to remember that the user came from the product feedback form
            session(['from_productFeedback' => true, 'product_id' => $request->input('product_id')]);
        
            // Redirect back with the error message and input data
            return redirect()->back()->with('error', 'Please log in to submit your reviwe.')->withInput();
        }

        ProductFeedback::create([
            'rating'=>$request->input('rating'),
            'feedback'=>$request->input('feedback'),
            'user_id'=>auth()->id(),
            'product_id'=>$request->input('product_id'),
        ]);

        return redirect()->back()->with('success', 'Thank you for sharing your reviwe');
    }

    /**
     * Display the specified resource.
     */
    public function show($product_id, ProductFeedback $productFeedback)
    {
        return view('dashboard.product_feedbacks.show' , ['productFeedback'=> $productFeedback]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductFeedback $productFeedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductFeedback $productFeedback)
    {
        $validation = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string',
        ]);

      $productFeedback->update ([
            'rating'=>$request->input('rating'),
            'feedback'=>$request->input('feedback'),
            'user_id'=>auth()->id(),
            'product_id'=>$request->input('product_id'),
        ]);
        return redirect()->back()->with('success', 'Thank you for updating your reviwe');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductFeedback $productFeedback)
    {

        $productFeedback->delete();

        $product_id = $productFeedback->product_id; 

        return to_route('productFeedbacks.index', ['product_id' => $product_id])->with('success', 'Review deleted');
    }

   
}
