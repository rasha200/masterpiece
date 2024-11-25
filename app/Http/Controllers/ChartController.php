<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use App\Models\Service;
use App\Models\Product;
use App\Models\Appointment;
use App\Models\ToAdoupt;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function chart()
    {
        $petsCount = Pet::count();
        $servicesCount = Service::count();
        $productsCount = Product::count();

        $weeklyAppointments = Appointment::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $weeklyAdoptions = ToAdoupt::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        return view('dashboard.chart', compact(
            'petsCount', 
            'servicesCount', 
            'productsCount', 
            'weeklyAppointments', 
            'weeklyAdoptions'
        ));
    }
}
