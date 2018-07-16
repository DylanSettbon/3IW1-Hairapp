$(document).ready(function() {
    $('#burger').on('click', function() {
        //var li = $('.sidebar_buttons');
        //var navbar = $('.nav ul');
        //navbar.append( li );
        $('.nav').toggleClass('open');
    });
});
//PAGE ADMIN
$(function () { $('#title').keyup( function () { $('#url').val( $("#title").val().replace(/\s/g, "_")); }) } )

$("input[id^='template']").click( function(){
    if( $(this).is(':checked') ) {
        $( "input[id^='template']" ).prop( "checked", false );
        $( this ).prop( "checked", true );
    }
});

//PAGE ADMIN FIN
function hairdresser( id ) {
    var h1 = document.getElementsByClassName('coiffeur-1');
    var h2 = document.getElementsByClassName('coiffeur-2');
    var h3 = document.getElementsByClassName('coiffeur-3');

    if( id === 1 ){
        h1.show();
        h2.hide();
        h3.hide();
    }
    else if( id === 2 ){
        h1.hide();
        h2.show();
        h3.hide();
    }
    else if( id === 3 ){
        h1.hide();
        h2.hide();
        h3.show();
    }
    else if( id === 'all' ){
        h1.show();
        h2.show();
        h3.show();
    }



}


$("input[id^='template']").click( function(){
    if( $(this).is(':checked') ) {
        $( "input[id^='template']" ).prop( "checked", false );

        $( this ).prop( "checked", true );
    }
});
