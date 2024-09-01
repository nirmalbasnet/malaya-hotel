<?php

namespace App\Http\Controllers\Frontend;

use App\BackendModel\Terms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermsController extends Controller
{
    public function termsAndCondition()
    {
        $data = Terms::first();
        return view('frontend.terms', compact('data'));
    }
}
