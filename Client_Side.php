<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client/Side DataTable</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
     <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./libs/jquery-ui/jquery-ui.min.css">
     <style>
       
       body {
           background-color: #f8f9fa; /* Couleur de fond légèrement grise */
       }

       .title-container {
           text-align: center;
           padding: 80px 0;
       }

       .title-container h1 {
           font-size: 3rem; /* Taille de la police plus grande */
           color: #007bff; /* Couleur bleue */
           font-weight: bold; /* Gras */
           text-transform: uppercase; /* Convertir en majuscules */
       }
   </style>
</head>
<body>
            <?php
            include('nav.php');
            ?>

            <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="title-container">
                <h1>Data Base Client Side</h1>
            </div>
        </div>
    </div>
    
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
            </tr>
        </thead>
        <tbody>
            <!-- Les données seront chargées dynamiquement ici -->
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
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
                ]
            });
        });
    </script>
</body>
</html>
