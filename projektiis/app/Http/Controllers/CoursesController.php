<?php

namespace System\Http\Controllers;

use System\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $courses = Auth::user()->courses()->get();
        //return view('courses.index', ['courses' => $courses]);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \System\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function teacher_show(Course $course){
        
        $course = Course::find($course->id);
        return view('teacher.show', compact('course'));
    }

    public function teacher_index(){
        $courses = Course::all();
            //return view('courses.index', ['courses' => $courses]);
        return view('teacher.index', compact('courses'));
        
    }


    public function show(Course $course)
    {
        //$course = Course::where('id', $course->id);
        $course = Course::find($course->id);
        return view('courses.show', compact('course'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \System\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \System\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \System\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
