@include('partials.header')

<!-- Haal alle database gegevens op -->

<table>
<thead>
	<tr><td colspan="4"><b>Hier staat alle gegevens van uit de database!</b></td></tr>
	<tr>
		<td>Leeftijd</td>
		<td>Schaal</td>
		<td>Salaris</td>
	</tr>
</thead>
@foreach($caoGlasTuin as $cgt)
	<tr>	
		<td>{{$cgt->age}}</td>
		<td>{{$cgt->group}}</td>
		<td>{{$cgt->value}}</td>
	</tr>
@endforeach
</table>

<br/>

<label for="">Geboorte datum  </label> <input type="date"/><br/>
<label for="">Datum in dienst </label> <input type="date"/><br/>
<label for="">Loon per uur </label><input type="text"/><br/>

<input type="submit"/>