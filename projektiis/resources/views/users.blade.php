@extends('layouts.app')

@section('navbar')
  @if (Auth::user()->hasRole('admin'))
    <li><a href="{{ url('users')}}">Users</a></li>
    <li><a href="{{ url('courses') }}">Courses</a></li>
  @endif
@endsection

@section('content')
    <div class="container">
      @if (Auth::user()->hasRole('admin'))
        <a href={{ url('users/create')}}><button type="button" class="btn btn-primary">Create new user</button></a>
      @endif

    @foreach (['admin',  'teacher', 'student'] as $role)
      @if ($role == 'admin')
          <h2>Admins</h2>
      @elseif ($role == 'teacher')
          <h2>Teachers</h2>
      @elseif ($role == 'student')
          <h2>Students</h2>
      @endif
      <hr>
      <table class="table table-striped table-hover table-bordered table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Username</th>
        @if ($role =='student')
            <th>Programme</th>
            <th>Year</th>
        @endif
            <th>Edit user</th>
        @if ($role != 'admin')
            <th>Delete user</th>
        @endif
          </tr>
        </thead>
        <tbody>
        @foreach ($users as $person)
          @if ($person->hasRole($role))
             <tr>
                 <td><a href="users/{{$person->id}}">{{$person->name}}</a></td>
                    <td>{{$person->surname}}</td>
                    <td>{{$person->username}}</td>
                @if ($person->hasRole('student'))
                    <td>{{$person->degree_programme}}</td>
                    <td>{{$person->study_year}}</td>
                @endif
              
                    
                    <td><button type="button" class="btn btn-info" onclick="edit({{$person->id}})">Edit</button></td>
                @if (!$person->hasRole('admin'))    
                    <td><button type="button" class="btn btn-danger" onclick="del_user({{$person->id}})">Delete</button></td>
                @endif
             </tr>
          @endif
          <script type="text/javascript">
                  function del_user(id){
                    window.location.href="{{url('delete_user')}}/"+id;
                  }
                  function edit(id){
                    window.location.href="{{url('edit_user')}}/"+id;
                  }
          </script>  
        @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <br>
    @endforeach
    

</div>
@endsection