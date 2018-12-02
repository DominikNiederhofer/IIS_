@extends('layouts.app')

@section('content')
<div class=" col-md-6 col-lg-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Evaluations</div>
    <div class="panel-body">
     	<table class="table list-group">
     		<body class="col-md-12">
     			<tr>
     				<th>Username</th>
     				<th>Name</th>
     				<th>Email</th>
     				<th></th>
            <th></th>
     			</tr>
		      @foreach($users as $user)
		      	<tr>
		      		<td>{{$user->username}}</td>
		      		<td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td></td>
              <td>
                <div>
                  @if ($term->hasValuate($user))
                    <form class="form-horizontal" method="get" action="{{route('valuate_edit', $term->id)}}">{{ csrf_field() }}<button type="submit" class="btn btn-primary">edit</button></form></td>
                  @else
                    <form class="form-horizontal" method="get" action="{{route('valuate_create', [$user->id, $term->id])}}">{{ csrf_field() }}<button type="submit" class="btn btn-primary">open</button></form></td>
                  @endif
                </div>
		      	</tr>
		      @endforeach
      		</body>
      	</table>
 

    </div>      
  </div>
</div>
@endsection