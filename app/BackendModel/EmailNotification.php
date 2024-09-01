<?php

namespace App\BackendModel;

use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    protected $table = 'email_notifications';
    protected $guarded = ['id'];
}
