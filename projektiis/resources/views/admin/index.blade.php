@extends('layouts.app')

@section('navbar')
  <li><a href="{{ url('users')}}">Users</a></li>
  <li><a href="{{ url('courses') }}">Courses</a></li>
@endsection

@section('content')
<div class=" col-md-6 col-lg-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Admin</div>
    <div class="panel-body">
     <ul class="list-group">
    	<strong>Name:</strong> {{Auth::user()->name}}
    	<br>
    	<strong>Username:</strong> {{Auth::user()->username}}
     </ul>

    </div>      
  </div>
</div>
@endsection