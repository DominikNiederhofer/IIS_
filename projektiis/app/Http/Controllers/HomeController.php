<?php

namespace System\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use System\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')){
            return view('admin.index')->with('user', Auth::user());
        }
        else if (Auth::user()->hasRole('teacher')){
            return view('teacher.index')->with('user', Auth::user());
        }else{
            return view('student.index')->with('user', Auth::user());
        }
    }
}
