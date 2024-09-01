<?php

namespace App\BackendModel;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = 'destinations';
    protected $guarded = ['id'];

    public function admin()
    {
        return $this->belongsTo('\App\BackendModel\Admin', 'created_by');
    }

    public function destinationImages()
    {
        return $this->hasMany('\App\BackendModel\DestinationImages', 'destination_id');
    }

    public function destinationItineraries()
    {
        return $this->hasMany('\App\BackendModel\DestinationItinerary', 'destination_id')->orderBy('day', 'ASC');
    }

    public function destinationReviews()
    {
        return $this->hasMany('\App\BackendModel\DestinationReview', 'destination_id')->orderBy('id', 'DESC');
    }
}
