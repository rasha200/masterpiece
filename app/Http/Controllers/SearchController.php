<?php

namespace App\Http\Controllers;

use App\Models\Search;
use App\Models\Product;
use App\Models\Pet;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Service;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class SearchController extends Controller
{


    public function search(Request $request)
{
    $query = $request->input('query');
    $type = $request->input('type'); 

    if ($type === 'products') {

        $results = Product::where('name', 'LIKE', '%' . $query . '%')->get();
        return view('dashboard.products.index', compact('results', 'query'));

    } elseif ($type === 'pets') {

        $results = Pet::where('name', 'LIKE', '%' . $query . '%')->get();
        return view('dashboard.pets.index', compact('results', 'query'));

    } elseif ($type === 'testimonials') {

        $results = Testimonial::where('content', 'LIKE', '%' . $query . '%')->get();
        return view('dashboard.testimonials.index', compact('results', 'query'));

    } elseif ($type === 'users') {

        $results = User::where('name', 'LIKE', '%' . $query . '%')->orWhere('email', 'LIKE', '%' . $query . '%')->get();
        return view('dashboard.user.index', compact('results', 'query'));

    } elseif ($type === 'services') {

        $results = Service::where('title', 'LIKE', '%' . $query . '%')->get();
        return view('dashboard.services.index', compact('results', 'query'));

    } elseif ($type === 'categories') {

        $results = Category::where('name', 'LIKE', '%' . $query . '%')->get();
        return view('dashboard.categories.index', compact('results', 'query'));

    } elseif ($type === 'contacts') {

        $results = Contact::where('message', 'LIKE', '%' . $query . '%')->get();
        return view('dashboard.contacts.index', compact('results', 'query'));

    } else {
        return redirect()->back()->with('error', 'Invalid search type.');
    }
}

    


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Search $search)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Search $search)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Search $search)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Search $search)
    {
        //
    }
}
