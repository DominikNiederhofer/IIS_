@extends('layouts.app')

@section('content')
<div class=" col-md-6 col-lg-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Results</div>
    <div class="panel-body">
      <table class="table list-group">
        <body>
          <tr>
            <th>Points</th>
            <th>Comment</th>
            <th>Insert</th>
            <th>Date</th>
          </tr>
          <tr>
            <td>{{$evaluation->points}}</td>
            <td>{{$evaluation->comment}}</td>
            <td>{{$evaluation->getTeacher()->username}}</td>
            <td>{{$evaluation->updated_at}}</td>
          </tr>
        </body>

      </table>
    </div>      
  </div>
</div>
@endsection