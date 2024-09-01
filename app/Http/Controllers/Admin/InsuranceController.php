<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\TravelInsurance;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InsuranceController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Travel Insurance'))
            return redirect('admin/access-denied');

        $insurance = TravelInsurance::first();
        return view('admin.insurance.create', compact('insurance'));
    }

    public function submit(Request $request)
    {
        if(!RoleManager::checkHasRoles('Travel Insurance'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'description' => 'required',
        ]);

        TravelInsurance::create([
            'description' => $request->description,
            'created_by' => Auth::guard('admin')->user()->id
        ]);
        return redirect('admin/travel-insurance')->with('message', 'Insurance clauses successfully created');
    }


    public function update(Request $request, $id)
    {
        if(!RoleManager::checkHasRoles('Travel Insurance'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'description' => 'required',
        ]);

        TravelInsurance::find($id)->update([
            'description' => $request->description,
            'created_by' => Auth::guard('admin')->user()->id
        ]);
        return redirect('admin/travel-insurance')->with('message', 'Insurance clauses successfully updated');
    }
}
