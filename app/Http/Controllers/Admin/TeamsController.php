<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\Team;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class TeamsController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Our Team'))
            return redirect('admin/access-denied');

        $teams = Team::orderBy('id', 'DESC')->paginate('10');
        return view('admin.teams.list', compact('teams'));
    }

    public function create()
    {
        if(!RoleManager::checkHasRoles('Our Team'))
            return redirect('admin/access-denied');

        return view('admin.teams.create');
    }

    public function submit(Request $request)
    {
        if(!RoleManager::checkHasRoles('Our Team'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
            'description' => 'required',
            'image' => 'required|image|dimensions:min_width=400,min_height=400',
        ]);

        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'description' => $request->description,
            'created_by' => Auth::guard('admin')->user()->id
        ];
        if ($request->hasFile('image')) {
            $originalImage = Image::make($request->file('image'));
            $mimeTypeArray = array_map('trim', explode('/', $originalImage->mime));
            $fileName = strtotime(date('Y-m-d H:i:s')) . uniqid() . '.' . $mimeTypeArray[1];
            $originalImage->resize(400, 400);
            $thumbnailPath = public_path() . '/images/teams/small/';
            $originalPath = public_path() . '/images/teams/big/';
            $originalImage->save($originalPath . $fileName);
            $originalImage->resize(100, 100);
            $originalImage->save($thumbnailPath . $fileName);
            $data['image'] = $fileName;
        }
        Team::create($data);
        return redirect('admin/our-team')->with('message', 'Team member successfully created');
    }

    public function edit($id)
    {
        if(!RoleManager::checkHasRoles('Our Team'))
            return redirect('admin/access-denied');

        $team = Team::find($id);
        return view('admin.teams.edit', compact('team'));
    }

    public function update(Request $request, $id)
    {
        if(!RoleManager::checkHasRoles('Our Team'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
            'description' => 'required',
        ]);


        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'description' => $request->description,
            'created_by' => Auth::guard('admin')->user()->id
        ];

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|dimensions:min_width=400,min_height=400',
            ]);
            $oldImage = Team::find($id)->image;
            if(file_exists(public_path() . '/images/teams/small/'.$oldImage))
            {
                unlink(public_path() . '/images/teams/small/'.$oldImage);
            }
            if(file_exists(public_path() . '/images/teams/big/'.$oldImage))
            {
                unlink(public_path() . '/images/teams/big/'.$oldImage);
            }
            $originalImage = Image::make($request->file('image'));
            $mimeTypeArray = array_map('trim', explode('/', $originalImage->mime));
            $fileName = strtotime(date('Y-m-d H:i:s')) . uniqid() . '.' . $mimeTypeArray[1];
            $originalImage->resize(400, 400);
            $thumbnailPath = public_path() . '/images/teams/small/';
            $originalPath = public_path() . '/images/teams/big/';
            $originalImage->save($originalPath . $fileName);
            $originalImage->resize(100, 100);
            $originalImage->save($thumbnailPath . $fileName);
            $data['image'] = $fileName;
        }
        Team::find($id)->update($data);
        return redirect('admin/our-team')->with('message', 'Team member successfully updated');
    }

    public function delete($id)
    {
        if(!RoleManager::checkHasRoles('Our Team'))
            return redirect('admin/access-denied');

        $oldImage = Team::find($id)->image;
        if(file_exists(public_path() . '/images/teams/small/'.$oldImage))
        {
            unlink(public_path() . '/images/teams/small/'.$oldImage);
        }
        if(file_exists(public_path() . '/images/teams/big/'.$oldImage))
        {
            unlink(public_path() . '/images/teams/big/'.$oldImage);
        }
        Team::find($id)->delete();
        return redirect()->back()->with('message', 'Team member successfully deleted');
    }
}
