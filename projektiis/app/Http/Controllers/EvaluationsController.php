<?php

namespace System\Http\Controllers;

use System\Term;
use System\Evaluation;
use Illuminate\Http\Request;
use System\User;
use Auth;

class EvaluationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($term_id)
    {
        $term = Term::where('id', $term_id)->first();
        $users = $term->users()->get();
        return view('evaluations.index', ['users' => $users])->with('term', $term);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id, $term_id)
    {
        $user = User::where('id', $user_id)->first();
        $term = Term::where('id', $term_id)->first();

        return view('evaluations.create', ['user' => $user])->with('term', $term);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id, $term_id)
    {
        $userin = User::where('id', $user_id)->first();
        $term = Term::where('id', $term_id)->first();

        $this->validate($request, [
            'points' => 'required|integer|min:0',
            'comment' => 'required|string',
        ]);
        $evaluation1 = new Evaluation();
        $evaluation1->points = $request->points;
        $evaluation1->comment = $request->comment;
        $evaluation1->teacher_id = Auth::user()->id;
        $evaluation1->save();

        $evaluation1->users()->attach($userin);
        $term->evaluations()->save($evaluation1);

        $users = $term->users()->get();
        return $this->index($term->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \System\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show($term_id)
    {
        $key = 0;
        $term = Term::where('id', $term_id)->first();
        $eval = Evaluation::where('term_id', $term_id)->get();
        
        foreach ($eval as $key) {
            if ($key->users()->first() == Auth::user())
                break;
        }

         return view('evaluations.show', ['evaluation' => $key]);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \System\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit($term_id)
    {
        $key = 0;
        $term = Term::where('id', $term_id)->first();
        $eval = Evaluation::where('term_id', $term_id)->get();
        foreach ($eval as $key) {
            if ($key->users()->first() == Auth::user())
                break;
        }
    
       return view('evaluations.edit', ['evaluation' => $key, 'term' => $term]);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \System\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $evaluation_id, $term_id)
    {
        $term = Term::where('id', $term_id)->first();
        $this->validate($request, [
            'points' => 'required|integer|min:0',
            'comment' => 'required|string',
        ]);
        $evaluation = Evaluation::find($evaluation_id);
        $evaluation->points = $request->points;
        $evaluation->comment = $request->comment;
        $evaluation->teacher_id = Auth::user()->id;
        $evaluation->save();

        return $this->index($term->id);
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
