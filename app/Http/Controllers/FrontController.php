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

      $rules = [
        'name' => 'required|min:3|alpha',
        'surname' => 'required|min:3|alpha',
        'family' => 'required|min:3|alpha',
        'birthdate' => 'required|date',
        'skills' => 'required'
      ];

      $messages = array(
        'name.required'=>'Полето с името е задължително',
        'name.min' => 'Дължината на името трябва да е поне 3 символа',
        'name.alpha' => 'Полето име може да съдържа само букви',
        'surname.required'=>'Полето презиме е задължително',
        'surname.min' => 'Дължината на презимето трябва да е поне 3 символа',
        'surname.alpha' => 'Полето презиме може да съдържа само букви',
        'family.required'=>'Полето фамилия е задължително',
        'family.min' => 'Дължината на фамилията трябва да е поне 3 символа',
        'family.alpha' => 'Полето фамилия може да съдържа само букви',
        'birthdate.required' => 'Полето с датата е задължително',
        'birthdate.date' => 'Форматът на датата е сгрешен',
        'skills.required' => 'Изберете поне една технология'
      );

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

      $rules = [
        'technology' => 'required|alpha_num'
      ];

      $messages = [
        'technology.required' => 'Полето технологии не може да бъде празно',
        'technology.alpha_num' => 'Не е разрешено използването на специални символи'
      ];

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

      return ['id' => $skill->id, 'name' => request('technology')];
    }

    public function submitUniversity()
    {

      $rules = [
        'name' => 'required|min:3|alpha_num',
        'accreditation' => 'required|numeric'
      ];

      $messages = [
        'name.required' => "Името на университета не може да бъде празно",
        'name.min' => "Името на университета не може да бъде по-малко от 3 символа",
        'name.alpha_num' => "Не е разрешено използването на специални символи за името",
        'accreditation.required' => "Полето акредитация не може да бъде празно",
        'accreditation.numeric' => "Оценката трябва да бъде число"
      ];

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

      return ['id' => $uni->id, 'name' => request('name')];
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
}
