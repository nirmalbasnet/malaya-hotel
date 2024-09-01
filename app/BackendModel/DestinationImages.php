<?php

namespace App\BackendModel;

use Illuminate\Database\Eloquent\Model;

class DestinationImages extends Model
{
    protected $table = 'destination_images';
    protected $guarded = ['id'];

    public function destination()
    {
        return $this->belongsTo('\App\BackendModel\Destination', 'destination_id');
    }
}
