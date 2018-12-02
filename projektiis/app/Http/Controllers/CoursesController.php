<?php

namespace System\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use System\Course;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')) {
            $courses = Course::orderBy('name')->get();
        } else {
            $courses = Auth::user()->courses()->get();
        }
            return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $this->validate($request, [
           'name' => 'required|string',
           'credits' => 'required|integer|max:100',
            'shortcut' => 'required|string',
            'type' => 'required|string',
        ]);

        $course1 = new Course();
        $course1->name = $request->name;
        $course1->shortcut = $request->shortcut;
        $course1->credits = $request->credits;
        $course1->type = $request->type;
        $course1->save();

        return $this->index();
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
    public function edit($course_id)
    {
        $course = Course::find($course_id);
        return view('courses.edit', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \System\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id)
    {
        $this->validate($request, [
        'name' => 'required|string|max:150',
        'credits' => 'required|integer|max:100',
        'type' => 'required|string|max:3',
        ]);

        $course1 = Course::find($course_id);
        $course1->name = $request->name;
        $course1->credits = $request->credits;
        $course1->type = $request->type;
        $course1->shortcut = $request->shortcut;
        $course1->save();

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \System\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($course_id)
    {
        $course = Course::where('id', $course_id)->first();
        $course->delete();
        return $this->index();
    }

}
