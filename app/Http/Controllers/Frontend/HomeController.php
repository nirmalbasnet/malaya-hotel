<?php

namespace App\Http\Controllers\Frontend;

use App\BackendModel\AboutUs;
use App\BackendModel\Banner;
use App\BackendModel\Destination;
use App\BackendModel\Guides;
use App\BackendModel\Testimony;
use App\ThirdParty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 'active')->orderBy('order_number', 'ASC')->get();
        $topDestinations = Destination::where('publish', 'yes')->where('top', 'yes')->orderBy('id', 'DESC')->get();
        $normalDestinations = Destination::where('publish', 'yes')->where('top', 'no')->orderBy('id', 'DESC')->get();
        $guides = Guides::orderBy('id', 'DESC')->get();
        $testimonies = Testimony::where('status', 'active')->orderBy('id', 'DESC')->get();
        return view('frontend.home', compact('banners', 'topDestinations', 'normalDestinations', 'guides', 'testimonies'));
    }
}
