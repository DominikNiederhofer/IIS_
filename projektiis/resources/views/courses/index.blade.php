@extends('layouts.app')

@section('content')
<div class=" col-md-6 col-lg-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Courses</div>
    <div class="panel-body">
     <ul class="list-group">
      @foreach($courses as $course)
        <li class="list-group-item"><a href="/courses/{{$course->id}}">{{$course->name}}</a></li>
      @endforeach
     </ul>

    </div>      
  </div>
</div>
@endsection