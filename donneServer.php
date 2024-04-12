<?php
$servername = "localhost";
$username = "black";
$password = "black";
$dbname = "boutique";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Définition de la table, des colonnes et de l'index
$table = 'user';
$primaryKey = 'idU';
$columns = array(
    array( 'db' => 'idU', 'dt' => 0 ),
    array( 'db' => 'nom', 'dt' => 1 ),
    array( 'db' => 'prenom', 'dt' => 2 ),
    array( 'db' => 'login', 'dt' => 3 ),
    array( 'db' => 'telephone', 'dt' => 4 )
);

// Requête SQL
$sql_details = array(
    'user' => $username,
    'pass' => $password,
    'db'   => $dbname,
    'host' => $servername
);

require( 'ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
?>
