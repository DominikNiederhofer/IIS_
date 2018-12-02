@extends('layouts.app')

@section('navbar')
  @if (Auth::user()->hasRole('admin'))
    <li><a href="{{ url('users')}}">Users</a></li>
    <li><a href="{{ url('courses') }}">Courses</a></li>
  @endif
@endsection

@section('content')
<div class="container">
  <form class="form-horizontal" method="post" action="{{route('courses_store')}}" enctype="multipart/form-data">{{ csrf_field() }}
  <div class="row">
    <label class="col-sm-2 col-form-label" for="name">Course name:</label>
    <div class="col-sm-5">
      <div class="form-group">
        <input type="text" name="name" class="form-control" autofocus>
      </div>
    </div>
  </div>

  <div class="row">
    <label for="credits" class="col-sm-2 col-form-label">Number of credits:</label>
    <div class="col-sm-5">
      <div class="form-group">
      <input type="number" value="1" name="credits" min="1" class="form-control" autofocus>
    </div>
    </div>
  </div>

  <div class="row">
    <label for="shortcut" class="col-sm-2 col-form-label">Shortcut:</label>
    <div class="col-sm-5">
      <div class="form-group">
      <input type="text" name="shortcut" class="form-control" autofocus>
    </div>
    </div>
  </div>


  <div class="row">
      <label class="col-sm-2 col-form-label">Type:</label>
      <div class="col-sm-5">
        <div class="form-group">
          <select name="type" class="form-control">
              <option value="P">P</option>
              <option value="V">V</option>
              <option value="PV">PV</option>
          </select>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-sm-2">
        <div class="form-group">
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
      </div>
  </div>
  </form>
</div>
@endsection
