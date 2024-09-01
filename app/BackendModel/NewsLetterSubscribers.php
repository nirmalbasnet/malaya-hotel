<?php

namespace App\BackendModel;

use Illuminate\Database\Eloquent\Model;

class NewsLetterSubscribers extends Model
{
    protected $guarded = ['id'];
    protected $table = 'news_letter_subscribers';
}
