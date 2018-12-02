@extends('layouts.app')

@section('navbar')
  @if (Auth::user()->hasRole('admin'))
    <li><a href="{{ url('users')}}">Users</a></li>
    <li><a href="{{ url('courses') }}">Courses</a></li>
  @endif
@endsection

@section('content')
<div class=" col-md-6 col-lg-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Courses</div>
    <div class="panel-body">
      @if (Auth::user()->hasRole('admin'))
        <form class="form-horizontal" method="get" action="{{route('courses_create')}}">{{ csrf_field() }}<button type="submit" class="btn btn-primary">Create course</button></form>   
      @endif
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Course</th>
              <th scope="col">Shortcut</th>
              <th scope="col">Type</th>
              <th scope="col">Credit</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($courses as $course)
              <tr>
                <td><a href="/courses/{{$course->id}}">{{$course->name}}</a></td>
                <td>{{$course->shortcut}}</td>
                <td>{{$course->type}}</td>
                <td>{{$course->credits}}</td>
                @if (Auth::user()->hasRole('admin'))
                  <td><form class="form-horizontal" method="get" action="{{route('courses_edit', $course->id)}}">{{ csrf_field() }}<button type="submit" class="btn btn-info">Edit</button></form></td>
                  <td><form class="form-horizontal" method="post" action="{{route('courses_destroy', $course->id)}}">{{ csrf_field() }}{{ method_field('DELETE') }}<button type="submit" class="btn btn-danger">Delete</button></form></td>
                @endif
              </tr>   
            @endforeach
          </tbody>
        </table>
      </div>
    </div>      
  </div>
</div>

@endsection