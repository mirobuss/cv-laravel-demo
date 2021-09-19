<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\CV;
use \App\Models\University;
use \App\Models\Skill;

use Carbon\Carbon;

class FrontController extends Controller
{

    public function index()
    {
        $universities = University::all();
        $skills = Skill::all();

        return view('user-input', compact('universities', 'skills'));
    }

    public function showCVs()
    {
      return view('cv-list');
    }

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
      $cv->details = "Примерен текст на CV-то, вкаран от някакъв хипотетичен input";
      $cv->save();
    }

    public function submitSkill()
    {
      dd(request()->all());
    }

    public function submitUniversity()
    {
      dd(request()->all());
    }

    public function getResults()
    {
      // \Illuminate\Support\Facades\DB::listen(function($query){
      //   logger($query->sql);
      // });

      $date_from = (new Carbon(request('date_from')))->toDateTimeString();
      $date_to =   (new Carbon(request('date_to')))->toDateTimeString();

      $users = User::whereBetween('birthdate', [$date_from, $date_to])->with('skills', 'university', 'cv')->get();

      return view('ajax.results', compact('users'));
    }
}
