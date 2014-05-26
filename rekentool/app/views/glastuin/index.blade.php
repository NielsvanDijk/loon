@include('partials.header')

<div id="container">
	<section id="intro">
		<h1>{{Lang::get('rekentool-home.Wat doet dit?')}}</h1>
		<p>Clutter and often about bringing order simply to the way of course, so much of design process show respect towards the leading edge in colour makes a word that's an exploration of anything other than what products become in efficiency.</p>
	</section>
	<section id="calculation">
		<p class="form-element">
			<label for="birthday">{{Lang::get('rekentool-home.Geboortedatum')}}</label>
			{{ Form::input('date', 'birthday', null, array('id' => 'birthday', 'area-required' => 'true', 'data-validation-type' => 'date')) }}
			<span class="error-message"></span>
		</p>
		<p class="form-element">
			<label for="caos">{{Lang::get('rekentool-home.Selecteer CAO')}}</label>
			{{ Form::select('caos', $caos , Input::old('caos'), array('id' => 'caos', 'area-required' => 'true', 'data-validation-type' => 'cao')) }}
		</p>
		<p class="form-element">
			<label for="salary">{{Lang::get('rekentool-home.Loon per uur')}}</label>
			<div class="form-element form-element-container">
				<span class="wage">
					{{ Form::text('salary', null, array('id' => 'salary', 'area-required' => 'true', 'data-validation-type' => 'salary', 'placeholder' => Lang::get('rekentool-home.Loon per uur'))) }}
				</span>
				<span class="error-message"></span>
			</div>
		</p>
		<p class="form-element">
			<label for="years_of_service">{{Lang::get('rekentool-home.Dienstjaren')}}</label>
			<div class="form-element form-element-container">
				<span class="wage">
					{{ Form::text('years_of_service', null, array('id' => 'years_of_service', 'area-required' => 'true', 'data-validation-type' => 'years_of_service', 'placeholder' => Lang::get('rekentool-home.Dienstjaren'))) }}
				</span>
				<span class="error-message"></span>
			</div>
		</p>
		{{ Form::submit(Lang::get('rekentool-home.Berekenen')) }}		
	</section>
	<section id="uitslag">
		<div id="real-time-data">
			<span>{{Lang::get('rekentool-home.Geboortedatum')}}:</span>
			<p class="value-date"></p>
			<span>{{Lang::get('rekentool-home.CAO')}}:</span>
			<p class="value-cao"></p>
			<span>{{Lang::get('rekentool-home.Loon per uur')}}:</span>
			<p class="value-salary"></p>
			<span>{{Lang::get('rekentool-home.Dienstjaren')}}:</span>
			<p class="value-years_of_service"></p>
		</div>
		<div id="result"></div>	
	</section>
</div>
@include('partials.footer')



<!-- <div id="validation-errors"></div> -->

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
					var diff = data.difference.toFixed(2);
					if( diff > 0 ) {
						$( '#result' ).append( '<h3>{{Lang::get("rekentool-home.Je verdient")}}<span>€ ' + diff + '</span>{{Lang::get("rekentool-home.te veel")}}!</h3>' );
					} else if( diff < 0 ) {
						$( '#result' ).append( '<h3>{{Lang::get("rekentool-home.Je verdient")}}<span>€ ' + (diff * -1)  + '</span>{{Lang::get("rekentool-home.te weinig")}}!</h3>' );
					} else {
						$( '#result' ).append( '<h3>{{Lang::get("rekentool-home.Je verdient precies genoeg")}}!</h3>' );
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