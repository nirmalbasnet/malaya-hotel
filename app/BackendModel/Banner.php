<?php

namespace App\BackendModel;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    protected $guarded = ['id'];

    public function admin()
    {
        return $this->belongsTo('\App\BackendModel\Admin', 'created_by');
    }
}
