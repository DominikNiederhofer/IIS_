<?php

namespace System\Http\Controllers;

use System\Exam;
use System\Course;

use Illuminate\Http\Request;


class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {        
        $course = Course::where('id', $id)->first();
        return view('exams.create', ['course' => $course]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id     
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
         $this->validate($request, ['type' => 'required|string',
            'max_students' => 'required|integer|min:0',
            'max_points' => 'required|integer|min:0',
        ]);
        $new_exam = new Exam();
        $new_exam->type = $request->type;
        $new_exam->max_students = $request->max_students;
        $new_exam->max_points = $request->max_points;
        $new_exam->save();

        $course = Course::where('id', $id)->first();
        $course->exams()->save($new_exam);

        return redirect()->route('courses.show', ['course' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \System\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \System\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \System\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \System\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
