<?php
/**
 * Created by PhpStorm.
 * User: hp pav 14
 * Date: 22-Dec-18
 * Time: 7:39 PM
 */

namespace App\Helpers;


use App\BackendModel\Admin;
use App\BackendModel\SubAdminRoles;
use Illuminate\Support\Facades\Session;

class RoleManager
{
    public static function checkHasRoles($role)
    {
        if(Session::has('subAdminsSessionArray'))
        {
            $subAdminsSessionArray = Session::get('subAdminsSessionArray');
            if(in_array($role, $subAdminsSessionArray))
            {
                return true;
            }else{
                return false;
            }
        }

        return true;
    }
}