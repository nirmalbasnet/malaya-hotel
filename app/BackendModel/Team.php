<?php

namespace App\BackendModel;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';
    protected $guarded = ['id'];
}
