<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Produit</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./libs/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

    <style>
        .navbar-brand {
            color: #333; /* Couleur du texte noir */
        }

        .navbar-nav li a {
            color: #333; /* Couleur du texte noir */
        }

        .navbar-nav li a:hover {
            color: #007bff; /* Couleur du texte bleu au survol */
        }

        body {
            background-color: #f8f9fa; /* Couleur de fond légèrement grise */
            padding-top: 10px; /* Ajout de padding-top pour éviter que le navbar ne se cache sous le contenu */
        }

        /* Style du texte du Toastr */
        .toast {
            color: #000000 !important; /* Couleur du texte noir */
            background-color: #28a745 !important; /* Couleur de fond verte */
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Ma Black Boutique</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Autocomplétion
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="AutoComInput.php">Auto. Jquery UI/Ajax</a>
                            <a class="dropdown-item" href="AutoComSelect.php">Auto. Select2</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Datatable
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="Client_Side.php">Data. Client/Side</a>
                            <a class="dropdown-item" href="Server_Side.php">Data. Server/Side</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Reporting
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="factfpdf.php">FPDF</a>
                            <a class="dropdown-item" href="AlphaFactfpdf.php">AlphaPDF </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Notif Sweet_Alert_2 et Toastr
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="formProd.php">Enregistrement produit</a>
                            <a class="dropdown-item" href="ListeProd.php">Suppression produit</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Tableau des produits -->
    <table id="dataTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>codeProd</th>
                <th>nomProd</th>
                <th>description</th>
                <th>image</th>
                <th>poid</th>
                <th>prixU</th>
                <th>prixV</th>
                <th>dateAjout</th>
                <th>dateModif</th>
                <th>Id user</th>
                <th>Action</th> <!-- Ajout de la colonne pour le bouton Delete -->
            </tr>
        </thead>
        <tbody>
            <!-- Les données seront chargées dynamiquement ici -->
        </tbody>
    </table>

    <!-- Scripts -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        // Fonction pour afficher les produits
        function displayProducts() {
            $('#dataTable').DataTable().ajax.reload(); // Recharge les données du DataTable
        }

        $(document).ready(function() {
            $('#dataTable').DataTable({
                "ajax": {
                    "url": "donneCS.php", // URL de votre script PHP qui récupère les données
                    "dataSrc": "" // Source des données
                },
                "columns": [
                    {"data": "idProd"},
                    {"data": "codeProd"},
                    {"data": "nomProd"},
                    {"data": "description"},
                    {"data": "image"},
                    {"data": "poid"},
                    {"data": "prixU"},
                    {"data": "prixV"},
                    {"data": "dateAjout"},
                    {"data": "dateModif"},
                    {"data": "idU"},
                    {
                        "render": function(data, type, row) {
                            return '<button onclick="deleteProduct(' + row.id + ')" class="btn btn-danger">Delete</button>';
                        }
                    } // Fonction de rendu pour le bouton Delete
                ]
            });
        });

        // Fonction pour supprimer un produit
        function deleteProduct(id) {
            swal({
                title: "Êtes-vous sûr ?",
                text: "Une fois supprimé, vous ne pourrez pas récupérer ce produit !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: 'DelectProd.php',
                        type: 'POST',
                        data: { id: id }, // Utilisez la clé 'id' pour envoyer l'ID
                        success: function(response) {
                            toastr.success(response);
                            displayProducts(); // Rafraîchir la liste des produits après suppression
                        },
                        error: function(xhr, status, error) {
                            toastr.error('Erreur lors de la suppression du produit.');
                            console.error('Erreur AJAX :', xhr.responseText);
                        }
                    });
                } else {
                    toastr.info("Le produit n'a pas été supprimé.");
                }
            });
        }
    </script>
</body>
</html>
