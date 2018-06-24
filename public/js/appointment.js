$(document).ready(function() {

    //Decoche les autres coiffeur des qu'un coiffeur est selectionné et les met en gris
    $("input[id^='coiffeur']").click( function(){
        if( $(this).is(':checked') ) {
            $( "input[id^='coiffeur']" ).prop( "checked", false );

            $( this ).prop( "checked", true );
            console.log("")
        }
    });

    //Decoche les autres heures
    $("input[id^='heure']").click( function(){
        if( $(this).is(':checked') ) {
            $( "input[id^='heure']" ).prop( "checked", false );

            $( this ).prop( "checked", true );
        }
    });

    //a terminer
    var ladate=new Date()
    var cptMonth = ladate.getFullYear()?ladate.getMonth()+1 : 1
    showMonths(cptMonth)
    showDays(31)
    $("#annee").change(function(event){
        cptMonth = $('#annee :selected').text() == ladate.getFullYear()?ladate.getMonth()+1 : 1
        var year = event.target.value
        showMonths(cptMonth)
        $("#mois").change(function(event){
            days = daysInMonth(event.target.value,year)
            console.log(days)
            showDays(days)
        });
    });

    $("#annee,#mois").change(function(event){
        console.log(event)
    })
});

function updateDaysAndMonth(year) {
    $("#mois").change(function(event){
        days = daysInMonth(event.target.value,year)
        console.log(days)
        showDays(days)
    });
}


function showMonths(start){
    $('#mois').empty()
    for(i = start; i<=12;i++){
        $('#mois').append('<option value='+i+'>'+i+'</option>');
    }
}

function showDays(end,start=1){
    $('#jour').empty()
    for(i = start; i<=end;i++){
        $('#jour').append('<option value='+i+'>'+i+'</option>');
    }
}

function daysInMonth (month, year) {
    return new Date(year, month, 0).getDate();
}



/*
$('#package').change(function(){
    //$_POST : package, annee, mois, jour, hairdresser
    package = $('#package').find(":selected").val();
    year = $('#annee').find(":selected").text();
    month = $('#mois').find(":selected").text();
    day = $('#jour').find(":selected").text();
    hairdresser = $("input[id^='coiffeur']:checked").val();

    getAvailableHours(day,month,year,package,hairdresser)
});

function getAvailableHours(day,month,year,idPackage,idHairdresser){
    $.ajax({
        type: 'POST',
        url: 'ajaxTest',
        datatype: "json",
        data: { day: day,
                month:month,
                year : year,
                package :idPackage,
                hairdresser : idHairdresser},
        success: function(response) {
           console.log(JSON.parse(response))
        }
        });
}
*/
