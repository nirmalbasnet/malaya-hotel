<?php

namespace App\BackendModel;

use Illuminate\Database\Eloquent\Model;

class DestinationReview extends Model
{
    protected $table = 'destination_reviews';
    protected $guarded = ['id'];

    public function destination()
    {
        return $this->belongsTo('\App\BackendModel\Destination', 'destination_id');
    }
}
