$(document).ready(function() {

    //Decoche les autres coiffeur des qu'un coiffeur est selectionné et les met en gris
    $("input[id^='coiffeur']").click( function(){
        if( $(this).is(':checked') ) {
            $( "input[id^='coiffeur']" ).prop( "checked", false );

            $( this ).prop( "checked", true );
        }
    });

    //Decoche les autres heures
    $("input[id^='heure']").click( function(){
        if( $(this).is(':checked') ) {
            $( "input[id^='heure']" ).prop( "checked", false );

            $( this ).prop( "checked", true );
        }
    });
	
	
});