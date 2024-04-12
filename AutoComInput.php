<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Autocominput</title>
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
                <h1>Auto Compression Input jQuery UI/Ajax</h1>
            </div>
        </div>
    </div>
</div>
<form >
<div class="container">
    <div class="form-floating">
    <input type="text" id="libelle" autocomplete="off" class="form-control" name="libelle" placeholder="Recherche..." width="50%">
    <input type="hidden" id="libelle_id" class="form-control" name="libelle_id">
    </div>
  </div>
 
    
  </form>
  <script src="./libs/jquery-3.7.1.min.js"></script>
  <script src="./libs/bootstrap/js/bootstrap.min.js"></script>
  <script src="./libs/jquery-ui/jquery-ui.min.js"></script>
  <script src="script.js"></script> </body>
</html>
