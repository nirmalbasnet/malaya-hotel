<?php

namespace App\Http\Controllers\Frontend;

use App\BackendModel\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function aboutUs()
    {
        $aboutUs = AboutUs::first();
        return view('frontend.about-us', compact('aboutUs'));
    }
}
