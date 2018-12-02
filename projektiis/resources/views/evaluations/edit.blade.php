@extends('layouts.app')

@section('content')
<div class=" col-md-6 col-lg-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Edit result</div>
    <div class="panel-body">
    	<form class="form-horizontal" method="post" action="{{route('valuate_update', [$evaluation->id, $term->id])}}" enctype="multipart/form-data">{{ csrf_field()}}{{ method_field('PUT') }}
     	<table class="table list-group">
     		<body>
     			<tr>
     				<th>Points</th>
     				<th>Comment</th>
     			</tr>
     			<tr>
     				<td>
     					<div class="form-group">
     						<input type="integer" value="{{$evaluation->points}}" name="points" class="form-control" autofocus>
     					</div>
     				</td>
					<td>
						<div class="form-group">
     						<input type="text" value="{{$evaluation->comment}}" name="comment" class="form-control" autofocus>
     					</div>
     				</td>
     			</tr>
     			<tr>
     				<td>
     					<button type="submit" class="btn btn-primary">save</button>
     				</td>
     			</tr>
     		</body>

     	</table>
     	</form>
  
    </div>      

  </div>
</div>
@endsection