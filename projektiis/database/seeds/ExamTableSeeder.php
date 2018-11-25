<?php

use Illuminate\Database\Seeder;
use System\Exam;
use System\Course;

class ExamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$course_mat = Course::where('name', 'Math')->first();
        
        $exam1 = new Exam();
        $exam1->type = 'half';
        $exam1->max_students = 400;
        $exam1->max_points = 20;
        $exam1->save();
        $course_mat->exams()->save($exam1);

        $exam2 = new Exam();
        $exam2->type = 'final';
        $exam2->max_students = 400;
        $exam2->max_points = 60;
        $exam2->save();
        $course_mat->exams()->save($exam2);
        

    }
}
