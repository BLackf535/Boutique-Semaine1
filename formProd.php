<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'ajout d'un Utilisateur</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Ajout d'une couleur de fond légèrement grise */
        }
        .form-container {
            max-width: 500px;
            margin: auto;
            background-color: #fff; /* Ajout d'une couleur de fond pour le formulaire */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ajout d'une ombre */
            margin-top: 50px;
        }
    </style>
</head>
<body>

<?php
include('nav.php');
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="addPersonForm" method="POST" enctype="multipart/form-data" class="form-container">
                <div class="mb-3">
                    <label for="codeProd" class="form-label">CodeProd:</label>
                    <input type="text" id="codeProd" name="codeProd" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="nomProd" class="form-label">Nomprod:</label>
                    <input type="text" id="nomProd" name="nomProd" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <input type="text" id="description" name="description" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image :</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="poid" class="form-label">poids:</label>
                    <input type="number" id="poid" name="poid" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="prixU" class="form-label">prixU:</label>
                    <input type="number" id="prixU" name="prixU" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="prixV" class="form-label">prixV:</label>
                    <input type="number" id="prixV" name="prixV" class="form-control">
                </div>

                <select class="form-select" id="dropdownMenu" name="selectedValue" onchange="selectChange(this)">
                    <option value="">Sélectionner un élément</option>
                    <?php
                    // Vérifie si la variable $elements est définie et non null
                    if(isset($elements) && !is_null($elements)) {
                        // La variable $elements est définie et contient des données
                        foreach ($elements as $element) {
                            echo '<option value="' . $element['idU'] . '">' . $element['nom'] . '</option>';
                        }
                    } else {
                        // La variable $elements est soit non définie, soit null
                        // Traitez cette situation en conséquence ou affichez un message d'erreur
                        echo '<option value="">Aucun élément trouvé</option>';
                    }
                    ?>
                </select>

                <!-- Champs cachés pour dateAjout et dateModif -->
                <input type="hidden" id="dateAjout" name="dateAjout" value="<?= date('Y-m-d H:i:s') ?>">
                <input type="hidden" id="dateModif" name="dateModif" value="<?= date('Y-m-d H:i:s') ?>">

                <button type="button" onclick="addPerson()" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</div>

<script src="./libs/jquery-3.7.1.min.js"></script>
<script>
// Fonction pour charger les éléments dans le menu déroulant
function loadDropdownItems() {
    $.ajax({
        url: 'select.php', // Le fichier PHP qui récupère les éléments
        type: 'GET',
        success: function(response) {
            // Convertir la réponse JSON en objet JavaScript
            var elements = JSON.parse(response);

            // Sélectionner le menu déroulant par son identifiant
            var dropdownMenu = $('#dropdownMenu');

            // Supprimer les anciennes options s'il y en a
            dropdownMenu.empty();

            // Ajouter une option par défaut
            dropdownMenu.append($('<option></option>').text('Sélectionner un élément'));

            // Boucle à travers les éléments et créer une option pour chaque élément
            elements.forEach(function(element) {
                // Créer un élément d'option
                var option = $('<option></option>').attr('value', element.idU).text(element.nom);
                // Ajouter l'option au menu déroulant
                dropdownMenu.append(option);
            });
        },
        error: function(xhr, status, error) {
            console.error('Erreur AJAX :', xhr.responseText);
        }
    });
}


// Appel de la fonction pour charger les éléments au chargement de la page
$(document).ready(function() {
    loadDropdownItems();
});

// Fonction appelée lorsqu'un élément est sélectionné dans le menu déroulant
function selectChange(select) {
    var selectedValue = select.value;
    console.log('Élément sélectionné:', selectedValue);
    // Faites ce que vous voulez avec la valeur sélectionnée
}

function addPerson() {
    // Récupérer les valeurs des champs
    var codeProd = document.getElementById('codeProd').value;
    var nomProd = document.getElementById('nomProd').value;
    var description = document.getElementById('description').value;
    var image = document.getElementById('image').files[0];
    var poid = document.getElementById('poid').value;
    var prixU = document.getElementById('prixU').value;
    var prixV = document.getElementById('prixV').value;
    var dateAjout = document.getElementById('dateAjout').value;
    var dateModif = document.getElementById('dateModif').value;
    var selectedValue = document.getElementById('dropdownMenu').value;

    // Vérifier que tous les champs obligatoires sont remplis
    if (codeProd === '' || nomProd === '' || description === '' || image === undefined || poid === '' || prixU === '' || prixV === '' || selectedValue === '') {
        Swal.fire('Erreur', 'Veuillez remplir tous les champs obligatoires', 'error');
        return; // Arrêter l'exécution de la fonction si un champ est vide
    }

    Swal.fire({
        title: 'Êtes-vous sûr de vouloir ajouter ce Produit ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Oui',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            // Envoi des données au serveur
            var formData = new FormData();
            formData.append('codeProd', codeProd);
            formData.append('nomProd', nomProd);
            formData.append('description', description);
            formData.append('image', image);
            formData.append('poid', poid);
            formData.append('prixU', prixU);
            formData.append('prixV', prixV);
            formData.append('dateAjout', dateAjout);
            formData.append('dateModif', dateModif);
            formData.append('selectedValue', selectedValue);

            fetch('from1Prod.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Afficher une notification de succès
                Swal.fire('Succès', data, 'success').then((result) => {
                    // Rediriger vers la page souhaitée après que l'utilisateur a appuyé sur "OK"
                    window.location.href = 'ListeProd.php';
                });
            })
            .catch(error => {
                // Afficher une notification d'erreur
                Swal.fire('Erreur', 'Une erreur est survenue', 'error');
            });
        }
    });
}
</script>
</body>
</html>
