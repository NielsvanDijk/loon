@include('partials.header')

<div id="container">
	<section id="intro">
		<h1>{{Lang::get('rekentool-home.Wat doet dit?')}}</h1>
		<p>Clutter and often about bringing order simply to the way of course, so much of design process show respect towards the leading edge in colour makes a word that's an exploration of anything other than what products become in efficiency.</p>
	</section>
	<section id="calculation">
		{{ Form::open(array('route' => 'loon.calculate', 'action' => '', 'method' => 'post', 'name' => 'calculator')) }}
			<div class="form-element">
				<label for="birthday">{{Lang::get('rekentool-home.Geboortedatum')}}</label>
				{{ Form::select('day', $days , Input::old('day'), array('id' => 'day', 'area-required' => 'true')) }}
				{{ Form::select('month', $months , Input::old('month'), array('id' => 'month', 'area-required' => 'true')) }}
				{{ Form::select('year', $years , Input::old('year'), array('id' => 'year', 'area-required' => 'true')) }}
			</div>
			<div class="form-element">
				<label for="cao">{{Lang::get('rekentool-home.Selecteer CAO')}}</label>
				{{ Form::select('cao', $caos , Input::old('cao'), array('id' => 'cao', 'area-required' => 'true')) }}
			</div>
			<div class="form-element">
				<label for="salary">{{Lang::get('rekentool-home.Loon per uur')}}</label>
				<span class="wage">
					{{ Form::text('salary', null, array('id' => 'salary', 'area-required' => 'true', 'data-validation-type' => 'number', 'placeholder' => Lang::get('rekentool-home.Loon per uur'))) }}
				</span>
			</div>
			<div class="form-element">
				<label for="years_of_service">{{Lang::get('rekentool-home.Dienstjaren')}}</label>
				{{ Form::text('years_of_service', null, array('id' => 'years_of_service', 'area-required' => 'false', 'data-validation-type' => 'number', 'placeholder' => Lang::get('rekentool-home.Dienstjaren'))) }}
			</div>
			{{ Form::submit(Lang::get('rekentool-home.Berekenen')) }}
		{{ Form::close() }}
	</section>
	<section id="uitslag">
		<div id="real-time-data">
			<span>{{Lang::get('rekentool-home.Leeftijd')}}:</span>
			<p id="birthday-value"></p>
			<span>{{Lang::get('rekentool-home.CAO')}}:</span>
			<p id="cao-value"></p>
			<span>{{Lang::get('rekentool-home.Minimumloon')}}:</span>
			<p id="salary-value"></p>
			<span>{{Lang::get('rekentool-home.Dienstjaren')}}:</span>
			<p id="value-years_of_service"></p>
		</div>
		<div id="result"></div>	
	</section>
</div>
@include('partials.footer')



<!-- <div id="validation-errors"></div> -->

<script type="text/javascript">
$(function() {
	$('form[name="calculator"]').each(function(event) {
		var form = $(this);
		
		$('input, select', form).bind('blur, change', function(event) {
			if (!validateElement($(this))) {
				calculate();
			}
		});
		
		form.bind('submit', function(event) {
			var error = false;
			
			if (!(error = validateElements($(this)))) {
				calculate();
			}
			
			return !error;
		});
	});
	
	function validateElement(element) {
		var error = false;
		var errorMessage = '';
		
		var elementValue = element.val();
		var elementParent = element.parents('.form-element');
		
		if (undefined != element.attr('area-required')) {
			switch (element.attr('data-validation-type')) {
				case 'number':
					elementValue = elementValue.replace(',', '.');
					
					element.val(elementValue);
					
					if (isNaN(elementValue)) {
						error = true;
						errorMessage = 'Dit veld moet een getal zijn.';
					}
					break;
			}
			
			if ('' == elementValue || '0' == elementValue.toString()) {
				error = true;
				errorMessage = 'Dit veld is verplicht.';
			}

			if (error) {
				$('.error-message', elementParent).remove();
				
				elementParent.addClass('error').append(
					$('<span>').addClass('error-message').html(errorMessage)
				);
			} else {
				elementParent.removeClass('error');
				$('.error-message', elementParent).remove();
			}
		}

		return error;
	}
	
	function validateElements(form) {
		var error = false;
		
		$('input, select').each(function() {
			if (validateElement($(this))) {
				error = true;
			}
		});
		
		return error;
	}

	//function validate(element) {
		//if (element.is('[area-required="true"]')) {
		//	var error 			= false;
		//	var message 		= '';
		//	var elementValue	= element.val();
		//	var	elementParent	= element.closest('.form-element');

		//	switch (element.data('validation-type')) {
		//		case 'salary':
		//			elementValue = elementValue.replace(",", ".");
		//			if (!$.isNumeric(elementValue)) {
		//				error 	= true;
		//				message = 'unvalid number';
		//			}
		//			break;
		//		default:
		//			if ('' == elementValue || '0' == elementValue.toString()) {
		//				error = true;
		//				message = 'Dit veld is verplicht';
		//			}
		//			break;
		//	}

		//	if (error === true) {
		//		elementParent.find('.error').remove();
		//		elementParent.find('.error-message').append('<p class="error">' + message + '</p>');
		//	} 
		//	else {
		//		elementParent.find('.error').remove();
		//		calculate();
		//	}
		//}

		//console.log(element);
		//$('#calculation').find('[area-required="true"]').on('blur change', function() {
       	//	var validateInput   = $(this);
        //    var	field   		= validateInput.closest('.form-element');
        //    var	message 		= '';
        //    var	value   		= validateInput.val();
        //    var	error   		= false;

        //	console.log(validateInput);

        // switch( $(this).data('validation-type') ) { 
        //     case 'salary' :
        //         //value = value.replace(",", ".");
        //         //value = parseFloat(value).toFixed(2);
        //         // if(!isNaN(value)) {
        //         //     that.val(value);
        //         // }
	       //      // var re = /^\d+(?:\.\d\d?)?$/;
	       //      // if(!re.test(value)) {
	       //      //     error = true;
        //      //       	message = 'error message';
        //      //   	}
        //     break;

        //     case 'date':
        //         message = 'No valid date';
        //     break; 

        //     default:
        //         if( value == '' )
        //             error = true;

        //   	console.log(error);
	       //  }
		//});
	//}

	function calculate() {
		var result = $('#result');

		var dayInput 		= $('#day');
		var monthInput 		= $('#month');
		var yearInput 		= $('#year');
	 	var caoInput		= $('#cao');
	 	var salaryInput		= $('#salary');

	 	var birthdayValue 	= $('#birthday-value');
	 	var caoValue 		= $('#cao-value');
	 	var salaryValue 	= $('#salary-value');

		$.ajax({
			type 	: 'GET',
			url 	: '{{URL::route('loon.calculate')}}',
			data 	: {'day' : dayInput.val(), 'month' : monthInput.val(), 'year' : yearInput.val(), 'cao' : caoInput.val(), 'salary' : salaryInput.val()},
			success	: function(data) {
				var difference = data.differenceRounded;

				if (difference < 0) {
					result.html('<h3>{{Lang::get("rekentool-home.Je verdient")}}<span>€ ' + difference.toString().substr(1) + '</span>{{Lang::get("rekentool-home.te veel")}}!</h3>');
				} else if(difference > 0) {
					result.html('<h3>{{Lang::get("rekentool-home.Je verdient")}}<span>€ ' + difference  + '</span>{{Lang::get("rekentool-home.te weinig")}}!</h3>');
				} else {
					result.html('<h3>{{Lang::get("rekentool-home.Je verdient precies genoeg")}}!</h3>');
				}

				birthdayValue.html(data.age);
				caoValue.html(data.caoName);
				salaryValue.html(data.wageRounded);
			}
		});
	}


	// $('input[type="submit"]').on('click', function(event) {
	// 	event.preventDefault();

	// 	var birthdayInput 	= $('#birthday');
	// 	var caoInput		= $('#cao');
	// 	var salaryInput		= $('#salary');

	// 	$.ajax({
	// 		type 	: "GET",
	// 		url 	: "{{URL::route("loon.calculate")}}",
	// 		data 	: {"birthday" : birthdayInput.val(), "salary" : salaryInput.val(), "cao" : caoInput.val()},
	// 		beforeSend: function() { 
 //                $("#validation-errors").hide().empty();
 //                $("#result").empty();
 //            },
	// 		success: function(data) {
	// 			if(data.success == true){
	// 				var diff = data.difference.toFixed(2);
	// 				if( diff > 0 ) {
	// 					$( '#result' ).append( '<h3>{{Lang::get("rekentool-home.Je verdient")}}<span>€ ' + diff + '</span>{{Lang::get("rekentool-home.te veel")}}!</h3>' );
	// 				} else if( diff < 0 ) {
	// 					$( '#result' ).append( '<h3>{{Lang::get("rekentool-home.Je verdient")}}<span>€ ' + (diff * -1)  + '</span>{{Lang::get("rekentool-home.te weinig")}}!</h3>' );
	// 				} else {
	// 					$( '#result' ).append( '<h3>{{Lang::get("rekentool-home.Je verdient precies genoeg")}}!</h3>' );
	// 				}
	// 			} else{
	// 				var errors = data.errors;
 //                    if($.isPlainObject(errors)){
 //                        $.each(errors, function(index, value)
 //                        {
 //                            if (value.length != 0)
 //                            {
 //                                $("#validation-errors").append('<div class="alert alert-error">'+ value +'<div>');
 //                            }
 //                        });
 //                        $("#validation-errors").show();
 //                   	} else{ 
 //                   		$("#validation-errors").append('<div class="alert alert-error">'+ errors +'<div>');
 //                   		$("#validation-errors").show();
 //                   	}
	// 			}
	// 		},
	// 		error: function(xhr, textStatus, thrownError) {
	// 			console.log('fout');
	// 		}
	// 	});
	// });
});
</script>