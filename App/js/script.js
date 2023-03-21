$('#slider').on('change', function() {
    var value = $(this).val();
    // Iterate over each row in the table
    $('#my-table tbody tr').each(function() {
        var age = parseInt($(this).find('td:eq(1)').text()); // Get the age value
        // If age is less than the selected value, hide the row
        if (age < value) {
            $(this).hide();
        }
        // Otherwise, show the row
        else {
            $(this).show();
        }
    });
});



// $( function() {
//     var handle = $( "#custom-handle" );
//     $( "#slider" ).slider({
//         create: function() {
//             handle.text( $( this ).slider( "value" ) );
//         },
//         slide: function( event, ui ) {
//             handle.text( ui.value );
//         }
//     });
// } );


$( function() {
    $( "#speed" ).selectmenu();
} );