<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\Seo;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeoController extends Controller
{
	public function index()
	{
        if(!RoleManager::checkHasRoles('SEO'))
            return redirect('admin/access-denied');

        $data = Seo::first();
		return view('admin.seo', compact('data'));
	}

	public function submit(Request $request)
	{
        if(!RoleManager::checkHasRoles('SEO'))
            return redirect('admin/access-denied');

        $this->validate($request, [
			'meta_keyword' => 'required',
			'meta_description' => 'required',
		]);

		if(Seo::count() == 0)
        {
            Seo::create($request->except('_token'));
        }else{
		    Seo::first()->update($request->except('_token'));
        }

        return redirect()->back();
	}

}