@extends('layouts.app')

@section('content')
<div class="col-xs-12">
  <div class="panel panel-primary">
    <div class="panel-heading">Create new term</div>
    <div class="panel-body">
     <form class="form-horizontal" method="post" action="{{route('terms_store', $exam->id)}}" enctype="multipart/form-data">{{ csrf_field() }}

      <ul class="list-group">
       <li class="list-group-item">
         Term:
         <div class="form-group">
          <input type="datetime-local" name="term" class="form-control" autofocus>
          
         </div>
       </li>
       <li class="list-group-item">
         Registration open:
         <div class="form-group">
          <input type="datetime-local" name="open" class="form-control" autofocus>
          
         </div>
       </li> 
       <li class="list-group-item">
         Registration close:
         <div class="form-group">
          <input type="datetime-local" name="close" class="form-control" autofocus>
          
         </div>
       </li>  
      </ul>
     
      <button type="submit" class="btn btn-primary">Save</button>
    </form>

    </div>      
  </div>
</div>
@endsection