<?php

use Illuminate\Database\Seeder;
use System\User;
use System\Course;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course1 = new Course();
        $course1->name = 'Math';
        $course1->shortcut = 'MAT';
        $course1->type = 'P';
        $course1->credits = 5;
        $course1->save();

        $course5 = new Course();
        $course5->name = 'Physics';
        $course5->shortcut = 'PHY';
        $course5->type = 'P';
        $course5->credits = 6;
        $course5->save();

        $course2 = new Course();
        $course2->name = 'Programming';
        $course2->shortcut = 'PRO';
        $course2->type = 'P';
        $course2->credits = 7;
        $course2->save();

        $course3 = new Course();
        $course3->name = 'Czech language';
        $course3->shortcut = 'CZL';
        $course3->type = 'PV';
        $course3->credits = 4;
        $course3->save();

        $course4 = new Course();
        $course4->name = 'Assemblers';
        $course4->shortcut = 'ASE';
        $course4->type = 'P';
        $course4->credits = 6;
        $course4->save();

    }
}
