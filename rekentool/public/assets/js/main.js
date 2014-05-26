jQuery(document).ready(function($){

    /*
     * Single field validation
     */
     
    $('#calculation').find('[area-required="true"]').on('blur change', function() {
        var that    = $(this),
            field   = that.closest('.form-element'),
            message = '',
            value   = that.val(),
            error   = false;

        if( value == '' )
            error = true;

        switch( $(this).data('validation-type') ) { 
            case 'salary' :
                value = value.replace(",", ".");
                value = parseFloat(value).toFixed(2);
                if(!isNaN(value)) {
                    that.val(value);
                }
                var re = /^\d+(?:\.\d\d?)?$/;
                if( ! re.test( value ) )
                    error = true;
                    message = 'no valid decimal (example: 8.43)';
            break;

            case 'date':
                message = 'No valid date';
            break; 

            case 'cao':
                value = $('#caos option:selected').text();
            break; 

            case 'years_of_service':
                message = 'No valid number (example: 3)';
            break;

            default:
                if( value == '' )
                    error = true;
        }

        // Show errors
        if( error ){
            field.find('.error').remove();
            //field.addClass('has-error');
            field.find('.error-message').append('<p class="error">' + message + '</p>');
            //setTimeout('$(\'p.error\').slideUp(\'normal\',function(){$(this).remove()})',5000);
        }
        else{
            //field.removeClass('has-error');
            field.find('.error').remove();
        }

        // Real time update
        var input_value = 'value-' + $(this).data('validation-type');

        if( !error ){
            $('.'+input_value).empty();
            $('.'+input_value).text(value);
        }
        else{
            $('.'+input_value).empty();
        }
    });
});