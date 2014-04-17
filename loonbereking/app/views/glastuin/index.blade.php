<style type="text/css">
	table{border-collapse: collapse;}
	td{
		padding: 10px 20px;
		border:1px solid green;
	}
</style>
<table>

@foreach($caoGlasTuin as $cgt)

	<tr>	

		<td>{{$cgt->id}}</td>
		<td>{{$cgt->age}}</td>
		<td>{{$cgt->group}}</td>
		<td>{{$cgt->value}}</td>

	</tr>

@endforeach
</table>