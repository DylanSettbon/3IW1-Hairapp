$(document).ready(function() {
    //Initialisation au chargement de la page
    const date=new Date()
    var cptMonth = date.getFullYear()?date.getMonth()+1 : 1
    showMonths(cptMonth)
    year = $('#annee').find(":selected").val();
    month = $('#mois').find(":selected").val()
    showDays(daysInMonth(month,year),date.getDate())


    $("#annee").change(function(event){
        $('#mois').empty()
        $('#jour').empty()
        startedMonth = $('#annee :selected').text() == date.getFullYear()?date.getMonth()+1 : 1
        var year = event.target.value;
        showMonths(startedMonth)
        var month = $('#mois').find(":selected").val()
        refreshDay(daysInMonth(month,year))
    });

    $("#mois").change(function(event){
        $('#jour').empty()
        var lastMonthDay = daysInMonth(event.target.value,year)
        refreshDay(lastMonthDay)
    });
});

function refreshDay(lastMonthDay){
    var date=new Date()
    var year = $('#annee').find(":selected").val();
    var month = $('#mois').find(":selected").val();
    var start = year == date.getFullYear() && month == date.getMonth()+1? date.getDate() : 1
    showDays(lastMonthDay,start)
}

function showMonths(start){
    for(i = start; i<=12;i++){
        month = i<10? '0'+i : i;
        if(month != $('#mois').find(":selected").text()) {
            $('#mois').append('<option value=' + i + '>' + month + '</option>');
        }
    }
}

function showDays(end,start=1){
    for(i = start; i<=end;i++){
        day = i<10? '0'+i : i;
        if(day != $('#jour').find(":selected").text()) {
            $('#jour').append('<option value=' + i + '>' + i + '</option>');
        }
    }
}

function daysInMonth (month, year) {
    return new Date(year, month, 0).getDate();
}