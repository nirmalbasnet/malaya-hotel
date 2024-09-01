<?php

namespace App\BackendModel;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $table = 'contact_infos';
    protected $guarded = ['id'];
}
