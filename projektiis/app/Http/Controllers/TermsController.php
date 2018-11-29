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
    public function create($exam_id)
    {
        $exam = Exam::where('id', $exam_id)->first();
        return view('terms.create', ['exam' => $exam]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, ['term' => 'required|date',
            'open' => 'required|date',
            'close' => 'required|date',
        ]);
        $new_term = new Term();
        $new_term->term = $request->term;
        $new_term->open = $request->open;
        $new_term->close = $request->close;
        $new_term->save();

        $exam = Exam::find($id)->first();
        $exam->terms()->save($new_term);
        /////DODELAT!!!!
        $course  = Course::find(1);
        return redirect()->route('courses.show', ['course' => $course->id]);    
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
    public function destroy($term_id)
    {
        $term = Term::find($term_id);
        if ($term == null) {
            return back();
        }
        $term->delete();
        return back();
    }

    public function register($id, $term_id) {

        $numofreg = 0;
        
        $term = Term::where('id', $term_id)->first();
        $exam = Exam::where('id', $id)->first();

        if ($exam == null) {
            return redirect()->route('courses');
        }

        $tete = $exam->terms()->get();
        foreach ($tete as $ter) {
            if ($ter->isregistrated(Auth::user()) && $ter->term > \Carbon\Carbon::now()){
                return back();
            }

            if ($ter->isregistrated(Auth::user())){
                $numofreg++;
            }
        }
        if ($numofreg > 3){
            return back();
        }

        if ($exam->max_students > $term->users()->get()->count() &&
            $term->close > \Carbon\Carbon::now() && $term->open < \Carbon\Carbon::now()) {
            $term->users()->attach(Auth::user());
        }
        return back();

    }

    public function unregister($user, $term_id){
        
        $term = Term::where('id', $term_id)->first();
        
        if ($term->close > \Carbon\Carbon::now()) {
            $term->users()->detach($user);
        }

        return back();
    }
}
