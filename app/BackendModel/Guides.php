<?php

namespace App\BackendModel;

use Illuminate\Database\Eloquent\Model;

class Guides extends Model
{
    protected $table = 'guides';
    protected $guarded = ['id'];
}
