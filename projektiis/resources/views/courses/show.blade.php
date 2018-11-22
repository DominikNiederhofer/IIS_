@extends('layouts.app')

@section('content')
<div class=" col-md-6 col-lg-6">
  <div class="panel panel-primary">
    <div class="panel-heading">{{$course->name}}</div>
    <div class="panel-body">
     <ul class="list-group">
      	@foreach($course->exams as $exam)
      	<div class="col-lg-4">
      		<h2>{{ $exam->type }} test</h2>
      		<p class="text-danger">max: {{$exam->max_points}}</p>
      		<p> <a class="btn btn-primary" href="/exams/{{ $exam->id }}" role="button">open </a></p> 
      	</div>
      	@endforeach
      </ul>

    </div>      
  </div>
</div>
@endsection