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
        
        <table class="table list-group">
          <tbody>
            <tr>
              <th>Description</th>
              <th>Points</th>
              <th colspan="2">Registration</th>
              <th></th>

            </tr>
              @foreach($course->exams as $exam)
              <div>
                  <tr><td colspan="6" class="danger">{{$exam->type}} test</td></tr>
                  @foreach($exam->terms as $term)
                    <tr>
                      <td>{{$term->term}}</td>
                      <td>0</td>
                      <td>{{$term->registration()}}</td>
                                          
                    </tr>
                  @endforeach          
              </div>
              @endforeach
          </tbody>
        </table>
      @endif
      </ul>

    </div>      
  </div>
</div>
@endsection