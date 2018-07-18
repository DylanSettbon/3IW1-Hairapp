<div class="row">
    <h1 id="title-rdv" class="title col-l-10">Tableau de bord</h1>
</div>

<div class="stat container col-l-12 col-s-12">

    <div class="line col-l-8 col-s-12">

        <canvas id="line-chart"></canvas>

    </div>

    <div class="pie col-l-9 col-s-12">

        <div class="col-l-5 col-s-12">
            <h2>Statistiques de suivi d'utilisation</h2>

            <div class="statCard">
                <h3 class="titleCard" style="margin-bottom: 0px;">Nombre d'utilisateurs totals</h3>
                <p class="statValue"><?php echo $countUser;?></p>
            </div>

            <div class="statCard">
                <h3 class="titleCard">Nombre de rendez-vous passés</h3>
                <p class="statValue"><?php echo $countAppointment['pastAppointment'];?></p>
            </div>

            <div class="statCard">
                <h3 class="titleCard">Nombre de rendez-vous a venir</h3>
                <p class="statValue"><?php echo $countAppointment['futurAppointment'];?></p>
            </div>
        </div>

        <div class="card col-l-5 col-s-12   ">
            <h2 class="titleCard">Details des rôles utilisateurs</h2>
            <canvas id="pie-chart"></canvas>
        </div>

    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript" src="../public/js/dashboard.js"></script>
