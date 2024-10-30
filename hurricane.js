jQuery(document).ready( function($) {

    $('#hide-show-hurricane-details').click(function() { 
        $('.my-weather-details').toggle();
        //$("#hide-show-hurricane-details").toggleClass("dashicons dashicons-minus");
    } ); 

    $('#page').css( { background: 'red !important' } );
});
