<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\CV;
use \App\Models\University;
use \App\Models\Skill;
use App\Http\Helpers\GlobalHelper;

use Carbon\Carbon;
use Validator;
use Response;
use Session;
use DB;

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
      //dd(request()->all());

      $rules = GlobalHelper::getRules('submitCv');
      $messages = GlobalHelper::getMessages('submitCv'); ;

      $validator = Validator::make(request()->all(), $rules, $messages);

      if($validator->fails()){
        return back()->withInput()->withErrors($validator);
      }

      $jquery_date = request('birthdate');
      $date = (new Carbon($jquery_date))->toDateTimeString();

      $check_user = User::where('name','=', request('name'))
               ->where('surname', '=', request('surname'))
               ->where('family', '=', request('family'))
               ->where('birthdate', '=', $date)->first();

      if($check_user) {

         $user = $check_user;

      } else {

        $user = new User();
        $user->name = request('name');
        $user->surname = request('surname');
        $user->family = request('family');
        $user->birthdate = $date;
      }

      $user->university_id = request('university');
      $user->save();

      $user->skills()->attach(request('skills'));

      $cv = new CV();
      $cv->user_id = $user->id;
      $cv->details = "Примерен текст на CV-то, вкаран от някакъв хипотетичен input";
      $cv->save();

      Session::flash('message', 'CV-то е изпратено успешно.');
      Session::flash('code', 'success');

      return back();
    }

    public function submitSkill()
    {

      $rules = GlobalHelper::getRules('submitSkill');
      $messages = GlobalHelper::getMessages('submitSkill');

      $validator = Validator::make(request()->all(), $rules, $messages);

      if($validator->fails()){
        return Response::json(array(
            'success' => false,
            'errors' => $validator->getMessageBag()->toArray()

        ), 400);
      }

      $skill = new Skill();
      $skill->skill = request('technology');
      $skill->save();

      return ['id' => $skill->id, 'name' => request('technology'), 'success' => 'Записът е направен успешно'];
    }

    public function submitUniversity()
    {

      $rules = GlobalHelper::getRules('submitUniversity');
      $messages = GlobalHelper::getMessages('submitUniversity');

      $validator = Validator::make(request()->all(), $rules, $messages);

      if($validator->fails()){
        return Response::json(array(
            'success' => false,
            'errors' => $validator->getMessageBag()->toArray()
        ), 400);
      }

      $uni = new University();
      $uni->name = request('name');
      $uni->accreditation = request('accreditation');
      $uni->save();

      return ['id' => $uni->id, 'name' => request('name'), 'success' => 'Записът е направен успешно'];
    }

    public function getResults()
    {
      // \Illuminate\Support\Facades\DB::listen(function($query){
      //   logger($query->sql);
      // });
      //GlobalHelper::test();

      $rules = [
        'date_from' => 'date',
        'date_to' => 'date'
      ];

      $messages = [
        'date_from.date' => "Грешено форматирана дата",
        'date_to.date' => "Грешено форматирана дата"
      ];

      $validator = Validator::make(request()->all(), $rules, $messages);

      if($validator->fails())
      {
        //TODO
      }

      $date_from = (new Carbon(request('date_from')))->toDateTimeString();
      $date_to =   (new Carbon(request('date_to')))->toDateTimeString();

      $users = User::whereBetween('birthdate', [$date_from, $date_to])->with('skills', 'university', 'cv')->get();

      return view('ajax.results', compact('users'));
    }

    public function getAggregatedResults()
    {

      $rules = [
        'date_from' => 'date',
        'date_to' => 'date'
      ];

      $messages = [
        'date_from.date' => "Грешено форматирана дата",
        'date_to.date' => "Грешено форматирана дата"
      ];

      $validator = Validator::make(request()->all(), $rules, $messages);

      if($validator->fails())
      {
        //TODO
      }

      $date_from = (new Carbon(request('date_from')))->toDateTimeString();
      $date_to =   (new Carbon(request('date_to')))->toDateTimeString();

      // $date_from = (new Carbon('09/05/1983'))->toDateTimeString();
      // $date_to =   (new Carbon('09/16/2021'))->toDateTimeString();

     $resultset = DB::select("SELECT count(users.name) as 'candidates', TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age, sub.skill FROM users
                           INNER JOIN universities AS uni ON users.university_id = uni.id
                           INNER JOIN (SELECT skill, skill_id, user_id as s_user_id FROM skills
                           INNER JOIN skill_user ON skills.id = skill_user.skill_id) as sub on sub.s_user_id = users.id
                           WHERE users.birthdate BETWEEN '". $date_from."' AND '" . $date_to ."'
                           group by skill, age");

     // dd($resultset);

      return view('ajax.aggregated-results', compact('resultset'));
    }

}
