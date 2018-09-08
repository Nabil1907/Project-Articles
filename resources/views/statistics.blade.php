@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html>
<head>
	<title>ststistics</title>
</head>
<body>
 <div class="col-md-6">
 	<h1 class="page-header">
 		Statistics 
 		<small>website statistics</small>
 	</h1>
 	<div> 
 		
 		<table class="table table-hover">
 			<tr>
 				<td> <h5>   users </h5> </td>
 				<td> <h5> {{$users}}</h5> </td>
 			</tr>
 			<tr>
 				<td> <h5>   Articles </h5> </td>
 				<td> <h5> {{$articles}}</h5> </td>
 			</tr><tr>
 				<td> <h5>   likes </h5> </td>
 				<td> <h5> {{$likes}}</h5> </td>
 			</tr><tr>
 				<td> <h5>   comments </h5> </td>
 				<td> <h5> {{$comments}}</h5> </td>
 			</tr>
 		</table>
</div>
</div>

</body>
</html>
@endsection