<?php

namespace System\Http\Controllers;

use System\Term;
use Illuminate\Http\Request;
use System\Course;
use System\Exam;
use Auth;

class TermsController extends Controller
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
     * @param  \System\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \System\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \System\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \System\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        //
    }

    public function register($id, $term_id) {

        $term = Term::where('id', $term_id)->first();
        $exam = Exam::where('id', $id)->first();
        if ($exam == null) {
            return redirect()->route('courses');
        }
        if ($exam->max_students > $term->users()->get()->count() &&
            $term->close > \Carbon\Carbon::now() && $term->open < \Carbon\Carbon::now()) {
            $term->users()->attach(Auth::user());
        }

        $course = Course::find($id);
        return redirect()->route('courses.show', compact('course'));

    }
}
