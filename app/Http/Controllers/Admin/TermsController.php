<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\Terms;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TermsController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Terms & Conditions'))
            return redirect('admin/access-denied');

        $terms = Terms::first();
        return view('admin.terms.create', compact('terms'));
    }

    public function submit(Request $request)
    {
        if(!RoleManager::checkHasRoles('Terms & Conditions'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'description' => 'required',
        ]);
        Terms::create([
            'description' => $request->description,
            'created_by' => Auth::guard('admin')->user()->id
        ]);
        return redirect('admin/terms-and-conditions')->with('message', 'Terms and conditions successfully created');
    }


    public function update(Request $request, $id)
    {
        if(!RoleManager::checkHasRoles('Terms & Conditions'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'description' => 'required',
        ]);

        Terms::find($id)->update([
            'description' => $request->description,
            'created_by' => Auth::guard('admin')->user()->id
        ]);
        return redirect('admin/terms-and-conditions')->with('message', 'Terms and conditions successfully updated');
    }
}
