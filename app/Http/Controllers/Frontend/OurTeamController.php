<?php

namespace App\Http\Controllers\Frontend;

use App\BackendModel\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OurTeamController extends Controller
{
    public function index()
    {
        $ourTeam = Team::orderBy('id', 'Desc')->get();
        return view('frontend.our-team', compact('ourTeam'));
    }
}
