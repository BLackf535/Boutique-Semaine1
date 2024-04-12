<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autocomplétion Select2</title>
   
    
 <link rel="stylesheet" href="./libs/bootstrap/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="./libs/jquery-ui/jquery-ui.min.css"> -->
  <link rel="stylesheet" href="./libs/select2-4.1.0-rc.0/dist/css/select2.min.css">
  
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
                <h1>Autocomplétion avec jQuery UI/Ajax et Select2</h1>
            </div>
        </div>
    </div>

    
</div>
  <div class="container">
    <div class="form-floating">
      <select class="form-select" id="select-autocomplete" name="select-autocomplete">
      </select>
      <label for="select-autocomplete">Recherche</label>
    </div>
  </div>
   
    <script src="./libs/jquery-3.7.1.min.js"></script>
  <script src="./libs/bootstrap/js/bootstrap.min.js"></script>
  <!-- <script src="./libs/jquery-ui/jquery-ui.min.js"></script> -->
  <script src="./libs/select2-4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="script2.js"></script>
</body>
</html>
