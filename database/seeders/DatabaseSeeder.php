<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\University;
use \App\Models\User;
use \App\Models\Skill;
use \App\Models\CV;
use DB;

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
          'birthdate' => '1996-09-05 07:27:22',
          'university_id' => 1
        ]);

        User::create([
          'name' => 'Паскал',
          'surname' => 'Заимов',
          'family' => 'Лефтеров',
          'birthdate' => '1992-05-02 06:17:32',
          'university_id' => 2
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

        CV::create([
          'user_id' => 1,
          'details' => 'Примерен текст на CV-то, вкаран от някакъв хипотетичен input '
        ]);

        CV::create([
          'user_id' => 2,
          'details' => 'Някакъв примерен текст на CV-то, вкаран от някакъв хипотетичен input '
        ]);

        DB::table('skill_user')->insert([
          [
            'user_id' => 1,
            'skill_id' => 1
          ],
          [
            'user_id' => 1,
            'skill_id' => 2
          ],
          [
            'user_id' => 2,
            'skill_id' => 1
          ],
          [
            'user_id' => 2,
            'skill_id' => 3
          ],

        ]);
    }
}
