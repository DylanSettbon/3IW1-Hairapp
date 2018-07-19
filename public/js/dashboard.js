$.ajax({
    type: 'POST',
    url: '/admin/ajaxGetDashboardData',
    datatype: "json",
    success: function(response){

        data = JSON.parse(response)
        var rolesLabel = Object.keys(data['roles'])
        var rolesValue = Object.values(data['roles'])
        var labelLine = getLastMonth(Object.keys(data['labelLine']).length > 6 ? 6 : Object.keys(data['labelLine']).length)
        var signinValue = typeof data['signin'] == 'undefined'?0:Object.values(data['signin'])
        var appointmentValue = Object.values(data['appointment'])

        new Chart(document.getElementById("pie-chart"), {
            type: 'pie',
            data: {
                labels: rolesLabel,
                datasets: [{
                    label: "Utilisateurs (unités)",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: rolesValue
                }]
            },
            options: {
                title: {
                    display: true,
                }
            }
        });

        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: labelLine,
                datasets: [{
                    data: signinValue,
                    label: "Utilisateurs",
                    borderColor: "#3e95cd",
                    fill: false
                },
                    {
                        data: appointmentValue,
                        label: "Rendez-vous",
                        borderColor: "red",
                        fill: false
                    },
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Statistiques de prises de rendez-vous et d\'inscription par mois'
                }
            }
        });
    }

});

function getLastMonth(numberOfMonth) {
    var d = new Date();
    var lastMonth = []
    for(var i = numberOfMonth -2 ; i > -2; i--) {
        var month = new Date(d.getFullYear(),d.getMonth() - i,d.getDate()).getMonth()
        lastMonth.push(month == 0? 12 : month)
    }
    return getTextDate(lastMonth)
}

function getTextDate(monthArray) {
    for(var i = 0 ; i < monthArray.length; i++) {
        switch (monthArray[i]) {
            case 1:
                monthArray[i] = 'Janv.'
                break;
            case 2:
                monthArray[i] = 'Fevr.'
                break;
            case 3:
                monthArray[i] = 'Mars.'
                break;
            case 4:
                monthArray[i] = 'Avr.'
                break;
            case 5:
                monthArray[i] = 'Mai'
                break;
            case 6:
                monthArray[i] = 'Juin'
                break;
            case 7:
                monthArray[i] = 'Juil.'
                break;
            case 8:
                monthArray[i] = 'Aout'
                break;
            case 9:
                monthArray[i] = 'Sept.'
                break;
            case 10:
                monthArray[i] = 'Oct.'
                break;
            case 11:
                monthArray[i] = 'Nov.'
                break;
            case 12:
                monthArray[i] = 'Dec.'
                break;
        }
    }
    return monthArray
}
