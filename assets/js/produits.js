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
            success: function (response) {
                var data = JSON.parse(response);
                console.log(data);
                var data = JSON.parse(response);
                //console.log(data);
                var id = data.id;
                var html = `<tr id="unite_${id}">
                        <td>${nom}</td>
                        <td><button class="btn btn-danger" onclick="supprimerUnite(${id})">Supprimer</button></td>
                        <td><button class="btn btn-success" onclick="modifierUnite(${id},'${nom}')">Modifier</button></td>
                        </tr>`;
                $('#tbodyunite').append(html);

                var option = `<option id="option_unite_${id}" value="${id}" selected>${nom}</option>`;
                $('#unite').append(option);
                $('#nom').val("");
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
            success: function (response) {
                var data = JSON.parse(response);
                //console.log(data);
                var id = data.id;
                var html = `<tr id="produit_${id}">
                        <td>${designation}</td>
                        <td>${prix}</td>
                        <td>${nom}</td>
                        <td><button class="btn btn-danger" onclick="supprimerProduit(${id})">Supprimer</button></td>
                        <td><button class="btn btn-success" onclick="modifierProduit(${id},'${designation}',${prix})">Modifier</button></td>
                        </tr>`;
                $('#tbodyproduit').append(html);
                $('#designation').val("");
                $('#prix').val("");
                $('#unite').val("");
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
        success: function (response) {
            $(`#${id}`).remove();
        }
    });
}

function supprimerUnite(id) {
    var data = {
        id: id
    }
    var trUnite = `unite_${id}`;
    var optionUnite = `option_unite_${id}`;
    //console.log(id);
    $.ajax({
        type: "POST",
        url: "http://localhost/epicerie/controler/supUniteCont.php",
        data: data,
        success: function (response) {
            var data = JSON.parse(response);
            if (data.status == 'ok') {
                $(`#${trUnite}`).remove();
                $(`#${optionUnite}`).remove();
            } else {
                alert('unite utilisé');
            }
        }
    });
}
function modifierUnite(id, nom) {
    var html = `<tr id="unite_${id}">
                <td><input class="form-control" type="text" id="nom_unite_${id}" value="${nom}"></td>
                <td><button class="btn btn-success" onclick="validerModif(${id})">valider</button></td>
                </tr>`;
    $(`#unite_${id}`).replaceWith(html);
}
function validerModif(id) {
    var nom = $(`#nom_unite_${id}`).val();
    // console.log(nom);
    var data = {
        nom: nom,
        id: id
    }
    //console.log(data);
    $.ajax({
        type: "POST",
        url: "http://localhost/epicerie/controler/validerModif.php",
        data: data,
        success: function (response) {
            var html = `<tr id="unite_${id}">
            <td>${nom}</td>
            <td><button class="btn btn-danger" onclick="supprimerUnite(${id})">Supprimer</button></td>
            <td> <button class="btn btn-success" onclick="modifierUnite(${id},'${nom}')">Modifier</button></td>
        </tr>`;
            $(`#unite_${id}`).replaceWith(html);
            var option = `<option id="option_unite_${id}" value=" ${id}" selected>${nom}</option>`;

            //<option id="option_unite_${id}" value="${id}" selected>${nom}</option>
            $(`#option_unite_${id}`).replaceWith(option);
        }
    });
}
function modifierProduit(id, designation, prix) {
    var select = recupererUnites();
    var html = `<tr id="produit_${id}">
    <td><input class="form-control" type="text" id="designation_modif_${id}" value="${designation}"></td>
    <td><input class="form-control" type="number" id="prix_modif_${id}" value="${prix}"></td>
    <td>${select}</td>
	<td><button class="btn btn-success" onclick="validerModifprod(${id})">Valider</button></td>
    </tr>`;
    //  console.log(html);
    $(`#produit_${id}`).replaceWith(html);
}
function validerModifprod(id){
    var designation = $(`#designation_modif_${id}`).val();
    var prix = $(`#prix_modif_${id}`).val();
    var unite = $(`#unite_modif`).val();
    // console.log(unite);
    var data = {
        designation: designation,
        prix: prix,
        unite: unite,
        id: id
    }
    //console.log(data);
    $.ajax({
        type: "POST",
        url: "http://localhost/epicerie/controler/validerModifprod.php",
        data: data,
        success: function (response) {
            var data = JSON.parse(response);
            //console.log(data);
            var html = `<tr id="produit_${id}">
            <td>${designation}</td>
            <td>${prix}</td>
            <td>${data.nom}</td>
            <td><button class="btn btn-danger" onclick="supprimerProduit(${id})">Supprimer</button></td>
            <td><button class="btn btn-success" onclick="modifierProduit(${id},'${designation}',${prix},${unite})">Modifier</button></td>
        </tr>`;
        $(`#produit_${id}`).replaceWith(html);
        }
    });
}
function recupererUnites() {
    //ajax recupere ts les unites
    var unites;
    $.ajax({
        type: "POST",
        url: "http://localhost/epicerie/controler/recupererUnites.php",
        async: false,
        success: function (response) {
            var data = JSON.parse(response);
            unites = data.unites;
            //console.log(unites);
        }
    });
    var option = "";
   // console.log(unites);
    unites.forEach((unite, key) => {
        //console.log(unite);
        option = `${option}
        <option id="modif_unite_${unite.id}" value="${unite.id}" selected>${unite.nom}</option>`
    });
    var select = `<select id="unite_modif" class="custom-select">${option}</select>`;
    return select;
}