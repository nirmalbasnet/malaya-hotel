<?php

namespace App\BackendModel;

use Illuminate\Database\Eloquent\Model;

class DestinationItinerary extends Model
{
    protected $table = 'destination_itineraries';
    protected $guarded = ['id'];

    public function destination()
    {
        return $this->belongsTo('\App\BackendModel\Destination', 'destination_id');
    }
}
