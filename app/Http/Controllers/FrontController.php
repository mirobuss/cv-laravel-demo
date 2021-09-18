<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use \App\Models\CV;
use Carbon\Carbon;

class FrontController extends Controller
{
    public function submitCv()
    {
      $jquery_date = request('birthdate');
      $date = (new Carbon($jquery_date))->toDateTimeString();

      //dd(request()->all());

      $user = new User();
      $user->name = request('name');
      $user->surname = request('surname');
      $user->family = request('family');
      $user->birthdate = $date;
      $user->university_id = request('university');
      $user->save();

      $user->skills()->attach(request('skills'));

      $cv = new CV();
      $cv->user_id = $user->id;
      $cv->save();
    }
}
