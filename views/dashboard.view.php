<div class="stat container col-l-10 col-s-12">
    <div class="col-l-10">
        <canvas id="line-chart"></canvas>
    </div>

    <div class="card col-l-6 col-s-12">
        <h2>Statistiques de suivi d'utilisation</h2>
        <table class="userManagerTab">
            <tr>
                <td><h3>Nombre d'utilisateurs totals</h3></td>
                <td><p>23</p></td>
            </tr>

            <tr>
                <td><h3>Moyenne des durée et des prix d'un rendez-vous</h3></td>
                <td><p>23</p></td>
            </tr>

            <tr>
                <td><h3>Nombre de rendez-vous passés</h3></td>
                <td><p>23</p></td>
            </tr>

            <tr>
                <td><h3>Nombre de rendez-vous a venir</h3></td>
                <td><p>23</p></td>
            </tr>


        </table>
    </div>

        <div class="card col-l-3 col-s-12">
            <canvas id="pie-chart"></canvas>
        </div>


    <div class="col-l-3 col-s-12">
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    new Chart(document.getElementById("line-chart"), {
        type: 'line',
        data: {
            labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
            datasets: [{
                data: [86,114,106,106,107,111,221,783,239,2478],
                label: "Utilisateurs",
                borderColor: "#3e95cd",
                fill: false
            },
                {
                    data: [100,324,76,45,34,645,112,321,245,167],
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

    new Chart(document.getElementById("pie-chart"), {
        type: 'pie',
        data: {
            labels: ["Administrateur", "Coiffeur", "Utilisateur", "Inactifs", "En attente de validation"],
            datasets: [{
                label: "Population (millions)",
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                data: [2478,5267,734,784,433]
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Details des rôles utilisateurs'
            }
        }
    });
</script>

<style>
    .stat{
        height: 50%;
    }


    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        text-align: center;
        background-color: #f2f2f2;
        height: 100%;
        margin: 20px;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
</style>