
<?php
// Récupérer les données du formulaire
$codeProd = $_POST['codeProd'];
$nomProd = $_POST['nomProd'];
$description = $_POST['description'];
$poid = $_POST['poid'];
$prixU = $_POST['prixU'];
$prixV = $_POST['prixV'];
$dateAjout = $_POST['dateAjout'];
$dateModif =$_POST['dateModif']; 
$selectedValue = $_POST['selectedValue'];

$dateModif = date('Y-m-d'); 
// Vérifier si un fichier a été téléchargé
if (isset($_FILES['image'])) {
    $imageName = $_FILES['image']['name']; // Nom de l'image
    $imageTmpName = $_FILES['image']['tmp_name']; // Emplacement temporaire de l'image sur le serveur
    $imageType = $_FILES['image']['type']; // Type MIME de l'image
    $imageSize = $_FILES['image']['size']; // Taille de l'image en octets

    $uploadDirectory = 'uploads/'; // Répertoire de stockage des images
    $imagePath = $uploadDirectory . $imageName; // Chemin complet de l'image sur le serveur

    // Déplacer le fichier téléchargé vers le répertoire de téléchargement
    if (move_uploaded_file($imageTmpName, $imagePath)) {
       // echo "L'image a été téléchargée avec succès";
    } else {
      //  echo "Erreur lors du déplacement du fichier téléchargé";
    }
} else {
    echo "Aucun fichier image téléchargé";
}

// Connexion à la base de données
$servername = "localhost";
$username = "black";
$password = "black";
$dbname = "boutique";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données: " . $conn->connect_error);
}

// Préparer et exécuter la requête SQL pour insérer les données
$query = "INSERT INTO produit (codeProd, nomProd, description,image, poid, prixU, prixV, dateAjout, dateModif, idU) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssssssss", $codeProd, $nomProd, $description,$imagePath, $poid, $prixU, $prixV, $dateAjout, $dateModif, $selectedValue);

if ($stmt->execute()) {
    echo " Succès de l'insertion";
} else {
    echo "  Erreur lors de l'insertion";
    echo "Erreur : " . $stmt->error;
}

$stmt->close();
$conn->close();
?>



