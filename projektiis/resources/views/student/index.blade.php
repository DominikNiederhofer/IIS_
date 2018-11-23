@extends('layouts.app')

@section('content')
<div class="col-md-12">
<div class="panel panel-primary">
	<div class="panel-heading">{{ $user->name }}</div>
	  <div class="panel-body">
	  	@foreach($user->courses as $course)
	  	
	  	<li class="list-group-item"><span class="col col-md-1">{{$course->shortcut}} </span>
	  		<a href="/courses/{{$course->id}}">{{$course->name}}</a>
	  	<span class="badge badge-primary">{{$course->type}} </span> </li>
        
        @endforeach
	      
	  </div>
	</div>
</div>
@endsection