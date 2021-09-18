<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\University;
use \App\Models\User;
use \App\Models\Skill;
use \App\Models\CV;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
          'name' => 'Иван',
          'surname' => 'Петров',
          'family' => 'Запрянов',
          'birthdate' => '1996-09-05 07:27:22'
        ]);

        User::create([
          'name' => 'Паскал',
          'surname' => 'Заимов',
          'family' => 'Лефтеров',
          'birthdate' => '1992-05-02 06:17:32'
        ]);

        University::create([
          'name' => 'ИУ Варна',
          'accreditation' => 9.2
        ]);

        University::create([
          'name' => 'УНСС',
          'accreditation' => 9.1
        ]);

        University::create([
          'name' => 'Транс-галактически Университет ТГУ-Мъск',
          'accreditation' => 9.8
        ]);

        Skill::create([
          'skill' => 'PHP'
        ]);

        Skill::create([
          'skill' => 'JavaScript'
        ]);

        Skill::create([
          'skill' => 'CSS3'
        ]);

        Skill::create([
          'skill' => 'HTML'
        ]);


    }
}
