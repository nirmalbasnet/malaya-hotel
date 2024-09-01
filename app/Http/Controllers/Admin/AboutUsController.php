<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\AboutUs;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AboutUsController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('About Us'))
            return redirect('admin/access-denied');

        $data = AboutUs::first();
        return view('admin.about-us', compact('data'));
    }

    public function submit(Request $request)
    {
        if(!RoleManager::checkHasRoles('About Us'))
            return redirect('admin/access-denied');

        $this->validate($request, [
           'description' => 'required'
        ]);

        if(AboutUs::count() == 0)
        {
            $data = $request->except('_token');
            $data['created_by'] = Auth::guard('admin')->id();
            AboutUs::create($data);
        }else{
            $data = $request->except('_token');
            $data['created_by'] = Auth::guard('admin')->id();
            AboutUs::first()->update($data);
        }

        return redirect()->back();
    }
}
