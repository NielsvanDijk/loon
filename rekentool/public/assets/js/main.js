jQuery.noConflict();
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
            break;

            // case 'date':
            //     var re = /^(((((0[1-9])|(1\d)|(2[0-8]))-((0[1-9])|(1[0-2])))|((31-((0[13578])|(1[02])))|((29|30)-((0[1,3-9])|(1[0-2])))))-((20[0-9][0-9]))|(29-02-20(([02468][048])|([13579][26]))))$/;
            //     if( ! re.test( value ) )
            //         error = true
            // break; 
            
            default:
                if( value == '' )
                    error = true;
        }

        if( error )
            field.addClass('has-error');
        else
            field.removeClass('has-error');
    });
});