<?php

namespace App\BackendModel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guarded = ['id'];
    protected $table = 'admins';

    public function banner()
    {
        return $this->hasMany('\App\BackendModel\Banner', 'created_by');
    }

    public function destination()
    {
        return $this->hasMany('\App\BackendModel\Destination', 'created_by');
    }
}