<?php

namespace System\Http\Controllers;

use System\Evaluation;
use Illuminate\Http\Request;
use System\User;
use System\Term;


class EvaluationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($exam_id, $term_id)
    {
        $term = Term::where('id', $term_id)->first();
        $users = $term->users()->get();
        return view('evaluations.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evaluations.create');
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
            'points' => 'required|integer|min:0',
            'comment' => 'required|string',
        ]);
        $evaluation1 = new Evaluation();
        $evaluation1->points = $request->points;
        $evaluation1->comment = $request->comment;
        $evaluation1->save();

        Auth::user()->evaluations()->attach($evaluation1);
    }

    /**
     * Display the specified resource.
     *
     * @param  \System\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \System\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \System\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \System\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
