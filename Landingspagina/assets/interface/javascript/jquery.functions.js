/* Javascript for Rekentool. */

/* ----------------------------------------------------------------------------------------- */
/* ----- jQuery onload --------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------- */
	
$(document).ready(function() {
	$('#nationality').on('change', function() {
		if ('else' == $(this).val()) {
			$('#nationality-else').parents('.form-element').slideDown();
		} else {
			$('#nationality-else').parents('.form-element').slideUp();
		}
	});
	
	if ('else' == $('#nationality').val()) {
		$('#nationality-else').parents('.form-element').show();
	}
	
	$('.error-desc').append(
		$('<a>').attr({'href': '#'}).addClass('error-desc-close').on('click', function() {
			$(this).parents('.error-desc').fadeOut();
			
			return false;
		})
	);
});