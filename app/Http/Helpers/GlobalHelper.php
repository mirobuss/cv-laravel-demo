<?php

namespace App\Http\Helpers;

class GlobalHelper {

  public static function getRules($context)
  {
    $rules = [
      'submitCv' => [
        'name' => 'required|min:3|alpha',
        'surname' => 'required|min:3|alpha',
        'family' => 'required|min:3|alpha',
        'birthdate' => 'required|date',
        'skills' => 'required'
      ],
      'submitSkill' => [
        'technology' => 'required|alpha_num'
      ],
      'submitUniversity' => [
        'name' => 'required|min:3|alpha_num',
        'accreditation' => 'required|numeric'
      ]
    ];

    return $rules[$context];
  }

  public static function getMessages($context)
  {
    $messages = [
      'submitCv' => [
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
      ],
      'submitSkill' => [
        'technology.required' => 'Полето технологии не може да бъде празно',
        'technology.alpha_num' => 'Не е разрешено използването на специални символи'
      ],
      'submitUniversity' => [
        'name.required' => "Името на университета не може да бъде празно",
        'name.min' => "Името на университета не може да бъде по-малко от 3 символа",
        'name.alpha_num' => "Не е разрешено използването на специални символи за името",
        'accreditation.required' => "Полето акредитация не може да бъде празно",
        'accreditation.numeric' => "Оценката трябва да бъде число"
      ]
    ];

    return $messages[$context];
  }

}
