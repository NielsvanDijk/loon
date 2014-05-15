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
<div class="loon-form">
	<p class="form-field">
		<label for="caos">{{Lang::get('rekentool-home.Selecteer CAO')}}</label>
		{{ Form::select('caos', $caos , Input::old('caos'), array('id' => 'caos', 'area-required' => 'true', 'data-validation-type' => 'cao')) }}
	</p>
	<p class="form-field">
		<label for="birthday">{{Lang::get('rekentool-home.Geboorte datum')}}</label>
		{{ Form::input('date', 'birthday', null, array('id' => 'birthday', 'area-required' => 'true', 'data-validation-type' => 'date')) }}
		<span class="error-message"></span>
	</p>
	<p class="form-field">
		<label for="salary">{{Lang::get('rekentool-home.Loon per uur')}}</label>
		{{ Form::text('salary', null, array('id' => 'salary', 'area-required' => 'true', 'data-validation-type' => 'salary', 'placeholder' => Lang::get('rekentool-home.Loon per uur'))) }}
		<span class="error-message"></span>
	</p>
	{{ Form::submit('Berekenen') }}
</div>
<div id="result"></div>
<div id="validation-errors"></div>
<div id="real-time-data"></div>

<script>
$( function() {
	$( 'input[type="submit"]' ).on( 'click', function( e ) {
		e.preventDefault();

		var birthday = $( '#birthday' ).val();
		var salary = $( '#salary' ).val();
		var cao = $( '#caos' ).val();

		$.ajax({
			type: "GET",
			url: "{{ URL::route( "loon.calculate" ) }}",
			data: { "birthday" : birthday, "salary" : salary, "cao" : cao },
			beforeSend: function() { 
                $("#validation-errors").hide().empty();
                $("#result").empty();
            },
			success: function(data){ 
				if(data.success == true){
					var diff = data.difference
					if( diff > 0 ) {
						$( '#result' ).text( 'Je verdient ' + diff + ' te veel!' );
					} else if( diff < 0 ) {
						$( '#result' ).text( 'Je verdient ' + (diff * -1)  + ' te weinig!' );
					} else {
						$( '#result' ).text( 'Je verdient precies genoeg!' );
					}
				} else{
					var errors = data.errors;
                    if($.isPlainObject(errors)){
                        $.each(errors, function(index, value)
                        {
                            if (value.length != 0)
                            {
                                $("#validation-errors").append('<div class="alert alert-error">'+ value +'<div>');
                            }
                        });
                        $("#validation-errors").show();
                   	} else{ 
                   		$("#validation-errors").append('<div class="alert alert-error">'+ errors +'<div>');
                   		$("#validation-errors").show();
                   	}
				}
			},
			error: function(xhr, textStatus, thrownError) {
                alert('Something went to wrong.');
			}
		});
	});
});
</script>