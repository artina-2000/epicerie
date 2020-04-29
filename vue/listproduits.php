<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="http://localhost/epicerie/assets/css/bootstrap.css">
	<title>Liste des produits</title>
</head>

<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="#">Epicerie</a>
		</nav>
		<br>
		<div class="row">
			<div class="col-md-8">
				<table class="table">
					<thead>
						<th>Désignation</th>
						<th>Prix</th>
						<th>Unité</th>
						<th>Action</th>
					</thead>
					<tbody id="tbodyproduit">
						<?php foreach ($lists as $key => $list) { ?>
							<tr id="produit_<?= $list['id'] ?>">
								<td><?= $list['designation'] ?></td>
								<td><?= $list['prix'] ?>Ar</td>
								<td><?= $list['nom'] ?></td>
								<td><button class="btn btn-danger" onclick="supprimerProduit(<?= $list['id'] ?>)">Supprimer</button></td>
							</tr>
						<?php	} ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Rechercher" aria-label="Rechercher" aria-describedby="button-addon2">
					<div class="input-group-append">
						<button class="btn btn-dark" type="button" id="button-addon2">Rechercher</button>
					</div>
				</div>
				<p>
					<button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
						Inserer Produit
					</button>

					<button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseEx" aria-expanded="false" aria-controls="collapseExample">
						Inserer Unité
					</button>
				</p>
				<div class="collapse" id="collapseExample">
					<div class="card card-body">
						<form>
							<div class="form-group">
								<label for="designation">Désignation</label>
								<input type="text" class="form-control" id="designation" placeholder="désignation">
							</div>
							<div class="form-group">
								<label for="prix">Prix</label>
								<input type="number" class="form-control" id="prix" placeholder="prix">
							</div>
							<div class="form-group">
								<label for="unite">Unité</label>
								<select class="custom-select" id="unite">
									<?php foreach ($unites as $key => $unite) { ?>
										<option value="<?= $unite['id'] ?>" selected><?= $unite['nom'] ?></option>
									<?php } ?>
								</select>
							</div>
							<button class="btn btn-dark" type="button" id="valider" onclick="enregistrerProduit()">Valider</button>
						</form>
					</div>
				</div>
				<div class="collapse" id="collapseEx">
					<div class="card card-body">
						<form>
							<div class="form-group">
								<label for="nom">nom unité</label>
								<input type="text" class="form-control" id="nom" placeholder="unité">
							</div>
							<button class="btn btn-dark" type="button" id="valider" onclick="enregistrerUnite()">Valider</button>
						</form>
					</div>
				</div>
				<table class="table">
					<thead>
						<th>Les unités</th>
					</thead>
					<tbody id="tbodyunite">
						<?php foreach ($unites as $key => $unite) { ?>
							<tr id="unite_<?= $unite['id'] ?>">
								<td><?= $unite['nom'] ?></td>
								<td><button class="btn btn-danger" onclick="supprimerUnite(<?= $unite['id'] ?>)">Supprimer</button></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	</div>
	<script src="http://localhost/epicerie/assets/js/jquery-3.3.1.min.js"></script>
	<script src="http://localhost/epicerie/assets/js/popper.min.js"></script>
	<script src="http://localhost/epicerie/assets/js/bootstrap.min.js"></script>
	<script>
		function enregistrerUnite() {
			var nom = $('#nom').val();
			//console.log(nom);
			var data = {
				nom: nom,
			};
			if (nom == "") {
				alert('veuillez remplir le champ!')
			} else {
				$.ajax({
					type: "POST",
					url: "http://localhost/epicerie/controler/insererUnite.php",
					data: data,
					success: function(response) {
						var data = JSON.parse(response);
						console.log(data);
						var data = JSON.parse(response);
						//console.log(data);
						var id = data.id;
						var html = `<tr id="unite_${id}">
								<td>${nom}</td>
								<td><button class="btn btn-danger" onclick="supprimerUnite(${id})">Supprimer</button></td>
							</tr>`;
						$('#tbodyunite').append(html);

						var option = `<option value="${id}" selected>${nom}</option>`
						$('#unite').append(option);
					}
				});
			}
		}

		function enregistrerProduit() {
			var designation = $('#designation').val();
			var prix = $('#prix').val();
			var unite = $('#unite').val();
			var nom = $('#unite').find('[value="' + unite + '"]').text();
			var data = {
				designation: designation,
				prix: prix,
				nom: nom,
				unite: unite
			};
			if (designation == "" || prix == "") {
				alert('Veuillez remplir tous les champs!')
			} else {
				$.ajax({
					type: "POST",
					url: "http://localhost/epicerie/controler/insererProduit.php",
					data: data,
					success: function(response) {
						var data = JSON.parse(response);
						//console.log(data);
						var id = data.id;
						var html = `<tr id="produit_${id}">
								<td>${designation}</td>
								<td>${prix}</td>
								<td>${nom}</td>
								<td><button class="btn btn-danger" onclick="supprimerProduit(${id})">Supprimer</button></td>
							</tr>`;
						$('#tbodyproduit').append(html);
					}
				});
			}
		}

		function supprimerProduit(id) {
			var data = {
				id: id
			}
			var id = `produit_${id}`;
			//console.log(id);
			$.ajax({
				type: "POST",
				url: "http://localhost/epicerie/controler/supProduitCont.php",
				data: data,
				success: function(response) {
					$(`#${id}`).remove();
				}
			});
		}

		function supprimerUnite(id) {
			var data = {
				id: id
			}
			var id = `unite_${id}`;
			console.log(id);
			$.ajax({
				type: "POST",
				url: "http://localhost/epicerie/controler/supUniteCont.php",
				data: data,
				success: function(response) {
					$(`#${id}`).remove();
				}
			});
		}
	</script>
</body>

</html>