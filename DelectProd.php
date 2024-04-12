<?php
// Connexion à la base de données
$servername = "localhost";
$username = "black";
$password = "black";
$dbname = "boutique";

// Récupérer l'ID du produit à supprimer
if (isset($_POST['id'])) {
    $id = $_POST['id']; // Utilisez $_POST['id'] pour récupérer l'ID

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données: " . $conn->connect_error);
    }

    // Vérifier si le produit existe
    $checkQuery = "SELECT idProd FROM produit WHERE idProd = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("i", $id);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // Supprimer le produit de la base de données
        $deleteQuery = "DELETE FROM produit WHERE idProd = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $id);

        if ($deleteStmt->execute()) {
            echo "Produit supprimé avec succès!";
        } else {
            echo "Erreur lors de la suppression du produit: " . $deleteStmt->error;
        }

        $deleteStmt->close();
    } else {
        echo "Produit non trouvé.";
    }

    $checkStmt->close();
    $conn->close();
} else {
    echo "Erreur : la clé 'id' n'est pas définie dans le tableau.";
}
?>