<?php

namespace App\BackendModel;

use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model
{
    protected $table = 'social_logins';
    protected $guarded = ['id'];
}
