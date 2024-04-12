<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server/Side DataTable</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

   <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="./libs/jquery-ui/jquery-ui.min.css">

   <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
  
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
                <h1>Data Base Serveur Side</h1>
            </div>
        </div>
    </div>
</div>
    
    <table id="dataTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Login</th>
                <th>Telephone</th>
            </tr>
        </thead>
        <tbody>
            <!-- Les données seront chargées dynamiquement ici -->
        </tbody>
    </table>

    
    <script src="./libs/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "donneServer.php", // URL du script PHP pour le traitement côté serveur
            });
        });
    </script>
</body>
</html>
