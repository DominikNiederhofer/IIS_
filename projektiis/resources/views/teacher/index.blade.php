@extends('layouts.app')

@section('content')
<div class="col-xs-12">
<div class="panel panel-primary">
	<div class="panel-heading">{{ $user->username }}</div>
	  <div class="panel-body">
	  	@if (count($user->courses) == 0)
	  		<span>{{$user->name}} has no registered course</span>
	  	@else
	  		<li class="list-group-item"><span class="col col-xs-1">Abrv</span>
			  		<span class="col-xs-4">Title</span>
			  		<span class="col-xs-offset-2">Students </span>
			  	<span class="badge badge-primary">Rests</span></li>
		  	@foreach($user->courses as $course)
			  	<li class="list-group-item"><span class="col col-xs-1">{{$course->shortcut}} </span>
			  		<a class="col-xs-4" href="courses/{{$course->id}}">{{$course->name}}</a>
			  		<span class="col-xs-offset-2">{{count($course->students())}} </span>
			  	<span class="badge badge-primary">0</span></li> 
	        @endforeach
	     @endif
	  </div>
	</div>
</div>
@endsection