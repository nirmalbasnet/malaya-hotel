<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\SocialMedia;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SocialMediaLinks extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Social Media Links'))
            return redirect('admin/access-denied');

        $links = SocialMedia::orderBy('social_media_type', 'ASC')->get();
        return view('admin.social-media.list', compact('links'));
    }

    public function create()
    {
        if(!RoleManager::checkHasRoles('Social Media Links'))
            return redirect('admin/access-denied');

        return view('admin.social-media.create');
    }

    public function submit(Request $request)
    {
        if(!RoleManager::checkHasRoles('Social Media Links'))
            return redirect('admin/access-denied');

        $createdBy = Auth::guard('admin')->user()->id;
        if(isset($request->facebook))
        {
            if(SocialMedia::where('social_media_type', 'facebook')->count() == 0)
            {
                SocialMedia::create([
                    'social_media_type' => 'facebook',
                    'social_media_link' => $request->facebook,
                    'created_by' => $createdBy
                ]);
            }else{
                SocialMedia::where('social_media_type', 'facebook')->update([
                    'social_media_link' => $request->facebook,
                ]);
            }
        }

        if(isset($request->twitter))
        {
            if(SocialMedia::where('social_media_type', 'twitter')->count() == 0)
            {
                SocialMedia::create([
                    'social_media_type' => 'twitter',
                    'social_media_link' => $request->twitter,
                    'created_by' => $createdBy
                ]);
            }else{
                SocialMedia::where('social_media_type', 'twitter')->update([
                    'social_media_link' => $request->twitter,
                ]);
            }
        }

        if(isset($request->youtube))
        {
            if(SocialMedia::where('social_media_type', 'youtube')->count() == 0)
            {
                SocialMedia::create([
                    'social_media_type' => 'youtube',
                    'social_media_link' => $request->youtube,
                    'created_by' => $createdBy
                ]);
            }else{
                SocialMedia::where('social_media_type', 'youtube')->update([
                    'social_media_link' => $request->youtube,
                ]);
            }
        }

        if(isset($request->instagram))
        {
            if(SocialMedia::where('social_media_type', 'instagram')->count() == 0)
            {
                SocialMedia::create([
                    'social_media_type' => 'instagram',
                    'social_media_link' => $request->instagram,
                    'created_by' => $createdBy
                ]);
            }else{
                SocialMedia::where('social_media_type', 'instagram')->update([
                    'social_media_link' => $request->instagram,
                ]);
            }
        }

        return redirect('admin/social-media-links');
    }

    public function remove($id)
    {
        if(!RoleManager::checkHasRoles('Social Media Links'))
            return redirect('admin/access-denied');

        SocialMedia::find($id)->delete();
        return redirect()->back();
    }
}
