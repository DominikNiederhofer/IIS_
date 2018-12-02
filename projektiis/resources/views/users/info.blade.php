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
    <div class="panel-heading">User Information</div>
	    <div class="panel-body">
	     <ul class="list-group">
	    	<strong>Name:</strong> {{$user->name}}
            <br>
            <strong>Surname:</strong> {{$user->surname}}
            <br>
            <strong>Email:</strong> {{$user->email}}
            <br>
            <strong>Username:</strong> {{$user->username}}
            <br>
            @if ($user->degree != null)
              <strong>Degree:</strong> {{$user->degree}}
            @endif
            <br>
            @if ($user->degree_programme != null)
                <strong>Degree programme:</strong> {{$user->degree_programme}}
            @endif
            <br>
            @if ($user->study_year != null)
                <strong>University year:</strong> {{$user->study_year}}
            @endif
	     </ul>
    	</div> 
    	
		    	@if ($user->hasRole('student') || $user->hasRole('teacher'))
	        <div class="panel-heading">Courses</div>
		    <div class="panel-body">
			    <div class="table-responsive">
		        <table class="table table-hover">
		          <thead>
		            <tr>
		              <th scope="col">Course</th>
		              <th scope="col">Shortcut</th>
		              <th scope="col">Type</th>
		              <th scope="col">Credit</th>
		              <th scope="col"></th>
		            </tr>
		          </thead>
		          <tbody>
		            @foreach ($user->courses()->get() as $course)
		              <tr>
		                <td>{{$course->name}}</td>
		                <td>{{$course->shortcut}}</td>
		                <td>{{$course->type}}</td>
		                <td>{{$course->credits}}</td>
		                <td><form class="form-horizontal" method="post" action="{{route('course_user_destroy', [$user->id, $course->id])}}">{{ csrf_field() }} {{ method_field('DELETE') }}<button type="submit" class="btn btn-primary">Delete</button></form></td>
		              </tr>
		              <script type="text/javascript">
		                  function del(course, user ){
		                    window.location.href="{{url('users')}}/"+course+"/"+user;
		                  }
		              </script>   
		            @endforeach
		          </tbody>
		        </table>
		    	</div>

		    	<br>
			    <button type="button" class="btn btn-primary " onclick="add_course({{$user->id}})">Add course</button>
			    @endif
			    <br>
	  		</div>

	  		


    </div>
</div>
  		
<script type="text/javascript">
  	function add_course(id){
  		window.location.href="{{url('users')}}/"+id+"/add";
  	}
</script>
@endsection