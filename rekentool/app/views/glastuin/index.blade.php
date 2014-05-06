@include('partials.header')

<!-- Haal alle database gegevens op -->

<!-- <table>
<thead>
	<tr><td colspan="4"><b>Hier staat alle gegevens van uit de database!</b></td></tr>
	<tr>
		<td>Leeftijd</td>
		<td>Schaal</td>
		<td>Salaris</td>
		<td>CAO</td>
	</tr>
</thead>
@foreach($salaries as $s)
	<tr>	
		<td>{{$s->age}}</td>
		<td>{{$s->catagory}}</td>
		<td>{{$s->value}}</td>
		
	</tr>
@endforeach
</table> -->

<h1>Glas en Tuinbouw</h1>

<label for="birthday">{{Lang::get('rekentool-home.Geboorte datum')}}</label>
	<input type="date" id="birthday" name="birthday"/><br/>

<label for="salary">{{Lang::get('rekentool-home.Loon per uur')}}</label>
	<input type="text" id="salary" placeholder="{{Lang::get('rekentool-home.Loon per uur')}}" name="salary"/>

<br/><input type="submit" value="Bereken"/>

<div id="result"></div>

<script>
$( function() {
	$( 'input[type="submit"]' ).on( 'click', function( e ) {
		e.preventDefault();

		$.get(
			'{{ URL::route( "loon.calculate" ) }}',
			{
				birthday : $( '#birthday' ).val(),
				salary   : $( '#salary' ).val()
			},
			function( data ) {
				var diff = data.difference;

				if( diff > 0 ) {
					$( '#result' ).text( 'Je verdient ' + diff + ' te veel!' );
				} else if( diff < 0 ) {
					$( '#result' ).text( 'Je verdient ' + (diff * -1)  + ' te weinig!' );
				} else {
					$( '#result' ).text( 'Je verdient precies genoeg!' );
				}
			}
		);
	} );
} );
</script>