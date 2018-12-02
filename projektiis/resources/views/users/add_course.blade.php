@extends('layouts.app')

@section('navbar')
  @if (Auth::user()->hasRole('admin'))
    <li><a href="{{ url('users')}}">Users</a></li>
    <li><a href="{{ url('courses') }}">Courses</a></li>
  @endif
@endsection

@section('content')

<div class="container">
  <br>
  <form method="post" action="{{route('course_user_add', $user->id)}}">
  {{ csrf_field() }}

  <div class="row">
      <label class="col-sm-2 col-form-label">Course:</label>
      <div class="col-sm-5">
        <div class="form-group">
          <select name="course" class="form-control" onchange="formItems(value ,'dynamic')">
              @foreach ($courses as $course)
                  <option value="{{$course->id}}">{{$course->name}}</option>
              @endforeach 
          </select>
          </div>
      </div>
  </div>

  <div class="row">
      <div class ="col-sm-2">
        <div class="form-group">
          <button class="btn btn-primary">Add</button>
        </div>
      </div>
  </div>
  @if (count($errors))
    <br><br>
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li> <strong>{{$error}}</strong></li>
        @endforeach
      </ul>
    </div>
  @endif
  </form>
</div>
@endsection
