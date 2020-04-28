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

		<div class="row">
			<div class="col-md-8">
				<table class="table">
					<thead>
						<th>Désignation</th>
						<th>Prix</th>
						<th>Unité</th>
					</thead>
					<tbody id="produit">
						<?php foreach ($lists as $key => $list) { ?>
							<tr>
								<td><?= $list['designation'] ?></td>
								<td><?= $list['prix'] ?>Ar</td>
								<td><?= $list['nom'] ?></td>
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
						Insérer
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
			</div>
		</div>
	</div>
	<script src="http://localhost/epicerie/assets/js/jquery-3.3.1.min.js"></script>
	<script src="http://localhost/epicerie/assets/js/popper.min.js"></script>
	<script src="http://localhost/epicerie/assets/js/bootstrap.min.js"></script>
	<script>
		function enregistrerProduit() {
			var designation = $('#designation').val();
			var prix = $('#prix').val();
			var unite = $('#unite').val();
			var nom = $('#unite').find('[value="' + unite + '"]').text();
			if (designation == "" || prix == "") {
				alert('Veuillez remplir tous les champs!')
			} else {
				var html = `<tr>
										<td>${designation}</td>
										<td>${prix}</td>
										<td>${nom}</td>
									</tr>`;
				$('#produit').append(html);
			}
		}
	</script>
</body>

</html>