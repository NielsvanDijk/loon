jQuery(document).ready(function($){

    /*
     * Single field validation
     */
    $('.loon-form').find('[area-required="true"]').on('blur', function() {
        var that    = $(this),
            field   = that.closest('.form-field'),
            value   = that.val(),
            error   = false;

        if( value == '' )
            error = true;

        switch( $(this).data('validation-type') ) { 
            case 'salary' :
                var re = /^\d+(?:\.\d\d?)?$/;
                if( ! re.test( value ) )
                    error = true;
                    message = 'no valid decimal (example: 8.43)';
            break;

            case 'date':
                message = 'no valid date';
            break; 

            case 'cao':
                value = $('#caos option:selected').text();
            break; 

            default:
                if( value == '' )
                    error = true;
        }

        // Show errors
        if( error ){
            field.find('.error').hide();
            field.addClass('has-error');
            field.find('.error-message').append('<p class="error">' + message + '</p>');
        }
        else{
            field.removeClass('has-error');
            field.find('.error').hide();
        }

        // Real time update
        var input_value = 'value-' + $(this).data('validation-type');

        if( !error ){
            $('.'+input_value).remove();
            $('#real-time-data').append('<span class="real-time-value ' + input_value + '">' + value + '</span>');
        }
        else{
            $('.'+input_value).remove();
        }
    });
});