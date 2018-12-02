@extends('layouts.app')

@section('navbar')
  @if (Auth::user()->hasRole('admin'))
    <li><a href="{{ url('users')}}">Users</a></li>
    <li><a href="{{ url('courses') }}">Courses</a></li>
  @endif
@endsection

@section('content')

  <div class="container">
      <form method="post" action="{{url('users/'.$person->id)}}">
      {{ method_field('PUT') }}
      {{ csrf_field() }}

      <div class="row">
          <label class="col-sm-2 col-form-label" for="validationName">Name:</label>
          <div class="col-sm-5">
            <div class="form-group">
              <input type="text" name="name" id="validationName" value="{{$person->name}}" class="form-control" autofocus>
            </div>
          </div>
      </div>

     <div class="row">
          <label class="col-sm-2 col-form-label" for="validationSurName">Surname:</label>
        <div class="col-sm-5">
          <div class="form-group">
          <input type="text" name="surname" id="validationSurName" value="{{$person->surname}}" class="form-control" autofocus>
        </div>
        </div>
      </div>


      <div class="row">
        <label class="col-sm-2 col-form-label" for="validationEmail">Email:</label>
        <div class="col-sm-5">
          <div class="form-group">
          <input type="text" name="email" value="{{$person->email}}" id="validationEmail" class="form-control" autofocus>
          </div>
        </div>
      </div>

      <div class="row">
        <label class="col-sm-2 col-form-label">Type of user</label>
          <div class="col-sm-5">
            <div class="form-group">
          <select name="user_type" class="form-control" onchange="formItems(value ,'dynamic')">
              <option value="admin">Admin</option>
              <option value="student">Student</option>
              <option value="teacher">Teacher</option>
          </select>
          </div>
        </div>
      </div>


      <div class="row">
          <div class ="col-sm-2">
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Update</button>
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