<?php

namespace App\Http\Controllers;


use App\BackendModel\NewsLetterSubscribers;
use App\User;

class TestController extends Controller
{
   public function userFactory()
   {
       factory(User::class, 3)->create();
   }

   public function subscribersFactory()
   {
       factory(NewsLetterSubscribers::class, 100)->create();
   }
}
