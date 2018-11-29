@extends('layouts.app')

@section('content')
<div class="col-xs-12">
  <div class="panel panel-primary">
    <div class="panel-heading">{{$course->name}}</div>
    <div class="panel-body">
     <ul class="list-group">  
        <table class="table list-group">
          <tbody>
            <tr>
              <th>Description</th>
              <th>Max points</th>
              <th>Max students</th>
              <th colspan="2">Registration</th>
              <th>
                @if (Auth::user()->hasRole('teacher'))
                    <form class="form-horizontal" method="get" action="{{route('exams_create', $course->id)}}">{{ csrf_field() }}<button type="submit" class="btn btn-primary">Create exam</button></form>
                @endif
              </th>

            </tr>
              @foreach($course->exams as $exam)
              <div>
                  <tr><td colspan="5" class="h3">{{$exam->type}} test</td>
                    @if (Auth::user()->hasRole('teacher'))
                      <td><form class="form-horizontal danger" method="get" action="{{route('terms_create', $exam->id)}}">{{ csrf_field() }}<button type="submit" class="btn btn-primary">Create term</button></form>
                      </td>
                    @endif
                  </tr>
                  @foreach($exam->terms()->orderBy('term')->get() as $term)
                    <tr>
                      <td>{{$term->term}}</td>
                      <td>{{$exam->max_points}}</td>
                      <td>{{count($term->users()->get())}}/{{$exam->max_students}}</td>
                      <td>{{$term->registration()}}</td>
                      @if (Auth::user()->hasRole('student'))
                        <td>
                          @if ($term->isregistrated(Auth::user()))
                            <div>
                              @if ($term->isEnded())
                                <form class="form-horizontal" method="post" action="{{route('')}}">{{ csrf_field() }}<button type="submit" class="btn btn-primary">View valuate</button></form>
                              @else
                                <form class="form-horizontal" method="post" action="{{route('terms_unregister', [Auth::user(), $term->id])}}">{{ csrf_field() }}<button type="submit" class="btn btn-primary">UnRegister</button></form>
                              @endif
                            </div>
                          @else
                            <div>
                              @if (!$term->isEnded())
                                <form class="form-horizontal" method="post" action="{{route('terms_register', [$exam->id, $term->id])}}">{{ csrf_field() }}<button type="submit" class="btn btn-primary">Register</button></form>
                              @endif
                            </div>
                          @endif
                        </td> 
                      @elseif (Auth::user()->hasRole('teacher'))
                         <td><form class="form-horizontal" method="get" action="{{route('terms_valuate', [$exam->id, $term->id])}}">{{ csrf_field() }}<button type="submit" class="btn btn-primary">Rate students</button></form></td>
                         <td><form class="form-horizontal" method="post" action="{{route('terms_destroy', $term->id)}}">{{ csrf_field() }} {{ method_field('DELETE') }}<button type="submit" class="btn btn-primary">Delete</button></form></td>
                      @endif                  
                    </tr>
                  @endforeach          
              </div>
              @endforeach
          </tbody>
        </table>
      </ul>

    </div>      
  </div>
</div>
@endsection