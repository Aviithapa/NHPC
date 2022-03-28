<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            [
               "name" => 'student',
                "display_name" =>'Student'
            ],
            [
                
               "name" =>'operator',
                "display_name" =>'Operator'
            ],
            [
              
                "name" =>  'officer',
                "display_name" =>'officer'
            ],
            [
                
               "name" =>'registrar',
                "display_name" => 'Registrar'
            ],
            [
                
               "name" =>'subject_committee',
                "display_name" => 'Subject Committee'
            ],
            [
               
                "name" => 'exam_committee',
                "display_name" =>'Exam Committee'
            ],
            [
               
                "name" => 'council',
                "display_name" => 'Council'
            ]
        ];

        DB::table('roles')->insert($roles);
    }
}
