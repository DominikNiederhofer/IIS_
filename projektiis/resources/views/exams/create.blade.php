@extends('layouts.app')

@section('content')
<div class="col-xs-12">
  <div class="panel panel-primary">
    <div class="panel-heading">Create new exam</div>
    <div class="panel-body">
     <form class="form-horizontal" method="post" action="{{route('exams_store', $course->id)}}" enctype="multipart/form-data">{{ csrf_field() }}
     <ul class="list-group">
       <li class="list-group-item">
         Type:
         <div class="form-group">
         <select name="type" value="{{old('type')}}" class="form-control">
                 <option value="half">Midterm exam</option>
                  <option value="final">Final exam</option>
          </select>
          </div>
       </li> 
       <li class="list-group-item">
        Max students: 
        <div class="form-group">
          <input type="number" name="max_students" class="form-control" value="{{old('max_students')}}" min="0" max="1000" autofocus>
        </div>
       </li> 
       <li class="list-group-item">
         
         Max points: 
         <div class="form-group">
          <input type="number" name="max_points" class="form-control" min="0" max="100" value="{{old('max_points')}}" autofocus>
        </div>
       </li> 
      </ul>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>

    </div>      
  </div>
</div>
@endsection