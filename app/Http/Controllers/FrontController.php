<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FrontController extends Controller
{
    public function submitCv()
    {
      //dd(request()->all());

      $user = new User();
      $user->name = request('name');
      $user->surname = request('surname');
      $user->family = request('family');
      $user->birthdate = request('birthdate');
      $user->save();

    }
}
