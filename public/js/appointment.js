$(document).ready(function() {
    //Initialisation au chargement de la page
    const date=new Date()
    var cptMonth = date.getFullYear()?date.getMonth()+1 : 1
    showMonths(cptMonth)
    year = $('#annee').find(":selected").val();
    month = $('#mois').find(":selected").val()
    showDays(daysInMonth(month,year),date.getDate())


    $("#annee").change(function(event){
        startedMonth = $('#annee :selected').text() == date.getFullYear()?date.getMonth()+1 : 1
        var year = event.target.value;
        showMonths(startedMonth)
        var month = $('#mois').find(":selected").val()
        refreshDay(daysInMonth(month,year))
    });

    $("#mois").change(function(event){
        var lastMonthDay = daysInMonth(event.target.value,year)
        refreshDay(lastMonthDay)
    });

    //Decoche les autres coiffeur des qu'un coiffeur est selectionné et les met en gris
    $("input[id^='coiffeur']").click( function(){
        if( $(this).is(':checked') ) {
            $( "input[id^='coiffeur']" ).prop( "checked", false );
            $( this ).prop( "checked", true );
        }
    });
})

function refreshDay(lastMonthDay){
    var date=new Date()
    var month = $('#mois').find(":selected").val()
    var year = $('#annee').find(":selected").val();
    var month = $('#mois').find(":selected").val();
    var start = year == date.getFullYear() && month == date.getMonth()+1? date.getDate() : 1
    showDays(lastMonthDay,start)
}

function showMonths(start){
    $('#mois').empty()
    for(i = start; i<=12;i++){
        $('#mois').append('<option value='+i+'>'+i+'</option>');
    }
}

function showDays(end,start = 1){
    $('#jour').empty()
    for(i = start; i<=end;i++){
        $('#jour').append('<option value='+i+'>'+i+'</option>');
    }
}

function daysInMonth (month, year) {
    return new Date(year, month, 0).getDate();
}

$('.appointmentAttr,:checkbox').change(function(){
    //$_POST : package, annee, mois, jour, hairdresser
    package = $('#package').find(":selected").val();
    year = $('#annee').find(":selected").text();
    month = $('#mois').find(":selected").text();
    day = $('#jour').find(":selected").text();
    hairdresser = $("input[id^='coiffeur']:checked").val();
    if(package != 'Choisir un forfait' && typeof hairdresser != undefined) {
        getAvailableHours(day, month, year, package, hairdresser)
    }
});

function getAvailableHours(day,month,year,idPackage,idHairdresser){
    $.ajax({
        type: 'POST',
        url: 'ajaxGetAvailableSchedule',
        datatype: "json",
        data: { day: day,
                month:month,
                year : year,
                package :idPackage,
                hairdresser : idHairdresser},
        success: function(response){
            showAllHour(JSON.parse(response))
        }
        });
}

function showAllHour(schedule)
{
    $( "#appointmentHour" ).empty();
    $( "#heure" ).empty();

    if (schedule['errors']){
        $("#hour").replaceWith('<p>'+schedule['errors']+'</p>');
        $("#appointmentHour").append('<p>'+schedule['errors']+'</p>');
        $('#heure').append('<option value="errors">' + schedule['errors'] + '</option>');
    }
    else {
        for (var i = 0; i < schedule.length; i++) {
            addHour(schedule[i],i)
            $('#heure').append('<option value=' + schedule[i] + '>' + schedule[i] + '</option>');
        }
    }
}

function addHour(hour,i){
    checked = i == 0? 'checked':''
    hourHtml = '<li>' +
        '<input value="'+hour+'" name="cbHeure" id="heure'+hour+'" type="checkbox" onchange="uncheckedHour(this)">' +
        '<label for="heure'+hour+'">' +
        '<span class="heure">'+hour+'</span>'+
        '</label>'+
        '</li>';

    $( "#appointmentHour" ).append(hourHtml);
}

function uncheckedHour(elmt){
    //Decoche les autres heures
    $( "input[id^='heure']" ).prop( "checked", false );
    $(elmt).prop( "checked", true );
}



