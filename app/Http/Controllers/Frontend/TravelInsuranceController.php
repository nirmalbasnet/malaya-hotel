<?php

namespace App\Http\Controllers\Frontend;

use App\BackendModel\TravelInsurance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TravelInsuranceController extends Controller
{
    public function travelInsurance()
    {
        $data = TravelInsurance::first();
        return view('frontend.travel-insurance', compact('data'));
    }
}
