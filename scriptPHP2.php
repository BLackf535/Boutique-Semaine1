<?php
// Connexion à la base de données et exécution de la requête de recherche
// Remplacez les valeurs ci-dessous par vos propres informations de connexion à la base de données
$servername = "localhost";
$username = "black";
$password = "black";
$dbname = "boutique";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué: " . $conn->connect_error);
}

// Récupération du terme de recherche
$term = $_GET['term'];

// Requête de recherche
$sql = "SELECT * FROM produit WHERE nomProd LIKE '%" . $term . "%' order by nomProd asc limit 10";

// Exécution de la requête
$result = $conn->query($sql);

// Récupération des résultats
$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = array(
            'id' => $row['idProd'],
            'text' => $row['nomProd']
        );
    }
}

// Renvoi des résultats au format JSON
echo json_encode($data);

// Fermeture de la connexion à la base de données
$conn->close();
?>