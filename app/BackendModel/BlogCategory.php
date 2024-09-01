<?php

namespace App\BackendModel;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = 'blog_categories';
    protected $guarded = ['id'];

    public function blogs()
    {
        return $this->hasMany('\App\BackendModel\Destination');
    }
}
