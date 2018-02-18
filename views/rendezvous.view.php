<?php include "templates/header.tpl.php";?>

<body id="body-rdv">
	<h1 id="title-rdv">Prendre rendez-vous</h1>
	<main id="main-rdv" class="col-s-11 col-l-8">
		<form>
			<section id="choix-coiffeur" class="row">
				<h2 class="title-section-rdv">Designez votre coiffeur</h2>
				<div class="container liste-coiffeur">
					<li>
					<input id="coiffeurTous" type="checkbox" checked>
						<label for="coiffeurTous" checked>
							<span class="nom-coiffeur">Tous</span>
						</label>
					</li>
					<li>
						<input id="coiffeur2" type="checkbox">
						<label for="coiffeur2">
							<span class="nom-coiffeur">Jerome</span>
						</label>
					</li>
					<li>
					<input id="coiffeur3" type="checkbox">
						<label for="coiffeur3">
							<span class="nom-coiffeur">Jerome1</span>
						</label>
					</li>
					<li>
					<input id="coiffeur4" type="checkbox">
						<label for="coiffeur4">
							<span class="nom-coiffeur">Jerome2</span>
						</label>
					</li>
					<li>
					<input id="coiffeur5" type="checkbox">
						<label for="coiffeur5">
							<span class="nom-coiffeur">Jerome3</span>
						</label>
					</li>
				</div>
			</section>

			<section id="selection-date" class="row">
				<h2 class="title-section-rdv">Selectionnez une date</h2>
					<div class="container date">
						<select name="jour" id="jour" class="liste_deroulante">
							<option hidden selected>Jour</option>
							<option value="jour">Jour</option>
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
						</select>

						<select name="mois" id="mois" class="liste_deroulante">
							<option hidden selected>Mois</option>
							<option value="Mois">Mois</option>
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
						</select>

						<select name="annee" id="annee" class="liste_deroulante">
							<option hidden selected value="2018">2018</option>
							<option value="2019">2019</option>
						</select>
					</div>
					<div class="container checkbox-heure-rdv">
						<li>
						<input id="heure1" type="checkbox" checked>
							<label for="heure1">
								<span class="heure">13h</span>
							</label>
						</li>
						<li>
							<input id="heure2" type="checkbox">
							<label for="heure2">
								<span class="heure">14h</span>
							</label>
						</li>
						<li>
							<input id="heure3" type="checkbox">
							<label for="heure3">
								<span class="heure">15h</span>
							</label>
						</li>
						<li>
							<input id="heure4" type="checkbox">
							<label for="heure4">
								<span class="heure">16h</span>
							</label>
						</li>
					</div>
				
				
				<select name="heure" id="heure" class="col-s-3 liste_deroulante">
					<option hidden selected>Heure</option>
					<option value="13">13h</option>
					<option value="13">14h</option>
					<option value="14">15h</option>
					<option value="15">16h</option>
				</select>
				
			</section>
		
			<section id="choix-forfait" class="row">
				<h2 class="title-section-rdv">Choissisez votre forfait</h2>
				<select name="heure" id="forfaits" class="col-s-12 liste_deroulante">
					<option value="coupeH">Coupe homme</option>
					<option value="coupeF">Coupe femme</option>
					<option value="shampoing">Shampoing</option>
					<option value="couleur">Couleur</option>
				</select>
				<a href="Carte.html">Voir la carte du salon</a>
			</section>
			
			<button type="button" name="btn-Valider" class="btn-Valider col-s-12 col-l-12">Valider</button>
		</form>
	</main>
</body>
<?php include "templates/footer.tpl.php"; ?>
<script type="text/javascript" src="../public/js/rendezvous.js"></script>
</html>



