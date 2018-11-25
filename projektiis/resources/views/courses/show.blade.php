@extends('layouts.app')

@section('content')
<div class="col-xs-12">
  <div class="panel panel-primary">
    <div class="panel-heading">{{$course->name}}</div>
    <div class="panel-body">
     <ul class="list-group">
      @if(count($course->exams()->get()) == 0)
        <span>no exams, tell your teacher to create some</span>
      @else
        
        <li class="list-group-item">
          <span class="col">Description</span>
        </li>

        @foreach($course->exams as $exam)

        <li class="list-group-item">
          <span class="col">{{ $exam->type }} test</span>
        </li>
        @endforeach
      @endif
      </ul>

    </div>      
  </div>
</div>
@endsection