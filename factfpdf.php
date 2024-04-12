<?php
require('libs/fpdf/fpdf.php');

class PDF extends FPDF
{
    // Tableau simple
    function BasicTable($header, $data)
    {
        // Calculer la largeur maximale pour chaque colonne
        $maxWidths = array();
        foreach ($header as $col) {
            $maxWidths[] = $this->GetStringWidth($col) + 4; // Ajouter un padding de 6 pour chaque colonne
        }
        foreach ($data as $row) {
            foreach ($row as $key => $col) {
                $colWidth = $this->GetStringWidth($col) + 4;
                if ($colWidth > $maxWidths[$key]) {
                    $maxWidths[$key] = $colWidth;
                }
            }
        }
        
        // En-tête
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($maxWidths[$i], 7, $header[$i], 1);
        }
        $this->Ln();
        
        // Données
        foreach ($data as $row) {
            for ($i = 0; $i < count($row); $i++) {
                $this->Cell($maxWidths[$i], 6, $row[$i], 1);
            }
            $this->Ln();
        }
    }
}

// Connexion à la base de données
$servername = "localhost";
$username = "black"; // Remplacez par votre nom d'utilisateur MySQL
$password = "black"; // Remplacez par votre mot de passe MySQL
$dbname = "boutique"; // Remplacez par le nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pdf = new PDF('L'); // 'L' indique l'orientation paysage
$pdf->SetFont('Arial','',12); // Réduire la taille de la police
$pdf->AddPage();

// Titres des colonnes
$header = array('NomProd', 'Image','Poids','PrixU','PrixV','DateAjout');

// Requête pour récupérer les données de la table produit
$sql = "SELECT * FROM produit";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    // Récupérer chaque ligne de données
    while($row = $result->fetch_assoc()) {
        $data[] = array($row["nomProd"],  $row["image"], $row["poid"], $row["prixU"], $row["prixV"], $row["dateAjout"]);
    }
} else {
    echo "0 results";
}

$conn->close();

$pdf->BasicTable($header,$data);

$pdf->Output();
?>


