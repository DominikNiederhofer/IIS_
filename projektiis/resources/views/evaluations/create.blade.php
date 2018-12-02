@extends('layouts.app')

@section('content')
<div class=" col-md-6 col-lg-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Insert result</div>
    <div class="panel-body">
    	<form class="form-horizontal" method="post" action="{{route('valuate_store', [$user->id, $term->id])}}" enctype="multipart/form-data">{{ csrf_field() }}
     	<table class="table list-group">
     		<body>
     			<tr>
     				<th>Points</th>
     				<th>Comment</th>
     			</tr>
     			<tr>
     				<td>
     					<div class="form-group">
     						<input type="integer" name="points" class="form-control" autofocus>
     					</div>
     				</td>
					<td>
						<div class="form-group">
     						<input type="text" name="comment" class="form-control" autofocus>
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