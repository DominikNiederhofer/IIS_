<?php

use Illuminate\Database\Seeder;
use System\Term;
use System\Course;

class TermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$course_mat = Course::where('name', 'Math')->first();
    	$exam_mat_half = $course_mat->exams()->first();

        $term1 = new Term();
        $term1->open = '2018-11-27 19:00:00';
        $term1->close = '2018-11-27 19:10:00';
        $term1->term  = '2018-11-28 19:00:00';
        $term1->save();

        $exam_mat_half->terms()->save($term1);

		$term2 = new Term();
        $term2->open = '2018-11-16 15:00:00';
        $term2->close = '2018-11-17 16:00:00';
        $term2->term  = '2018-11-18 12:00:00';
        $term2->save();

        $exam_mat_half->terms()->save($term2);


    }
}
