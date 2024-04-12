
<?php
require('libs/alphafpdf.php');
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

// $pdf = new PDF('L'); // 'L' indique l'orientation paysage
// $pdf->SetFont('Arial','',12); // Réduire la taille de la police
// $pdf->AddPage();

// Titres des colonnes


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

// class AlphaPDF extends FPDF
// {
//     // En-tête
//     function Header()
//     {
//         // Filigrane "Lenora"
//         $this->SetTextColor(128); // Définit la couleur du texte en gris
//         $this->SetAlpha(0.5); // Définit la transparence alpha à 0.3 (30% de transparence)
//         $this->SetFont('Arial', '', 150); // Définit la taille de la police à 90 points
//         $this->Rotate(45, 60, 80); // Rotation de 45 degrés
//         $this->Text(60, 80, 'Lenora');  // Affiche le texte "Lenora" aux coordonnées (60,80)
//         $this->Rotate(0); // Rétablit la rotation à 0 degré
//         $this->SetAlpha(1); // Rétablit la pleine opacité
//     }
// }

$pdf = new AlphaPDF('L');

$pdf->AddPage();

// Filigrane "Lenora"
$pdf->SetTextColor(128); // Définit la couleur du texte en gris
$pdf->SetAlpha(0.5); // Définit la transparence alpha à 0.3 (30% de transparence)
$pdf->SetFont('Arial', '', 150); // Définit la taille de la police à 90 points
$pdf->Text(30, 110, 'Liste Prod', 45);  // Affiche le texte "Lenora" aux coordonnées (60,80)
// $pdf->Image('image/beach.jpg',80,50,100);
$pdf->SetAlpha(1); // Rétablit la pleine opacité


$pdf->SetFont('Arial','',12); // Réduire la taille de la police
$pdf->SetLineWidth(1.5);


$header = array('NomProd', 'Image','Poids','PrixU','PrixV','DateAjout');





// En-tête du tableau
// $pdf->SetFont('Arial', 'i', $fontSize);
// $pdf->SetFillColor(150, 150, 150); // Couleur de fond de l'en-tête
$maxWidths = array();
        foreach ($header as $col) {
            $maxWidths[] = $pdf->GetStringWidth($col) + 1; // Ajouter un padding de 6 pour chaque colonne
        }
        foreach ($data as $row) {
            foreach ($row as $key => $col) {
                $colWidth = $pdf->GetStringWidth($col) + 1;
                if ($colWidth > $maxWidths[$key]) {
                    $maxWidths[$key] = $colWidth;
                }
            }
        }

        $pdf->SetFillColor(173, 216, 230); 
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128,0,0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('','B');
        
        // En-tête
        $w = array(40, 35, 45, 40);
        for($i=0;$i<count($header);$i++)
        $pdf->Cell($maxWidths[$i],7,$header[$i],1,0,'C',true);
        $pdf->Ln();

         // Restauration des couleurs et de la police
         $pdf->SetFillColor(224,235,255);
         $pdf->SetTextColor(0);
         $pdf->SetFont('');

// Données du tableau
// $pdf->SetFont('Arial', '', $fontSize);
// $pdf->SetFillColor(255, 255, 255); // Couleur de fond des cellules de données
$fill = false;
foreach($data as $row)
{
    for ($i = 0; $i < count($row); $i++) {
        $pdf->Cell($maxWidths[$i],6,$row[$i],'LR',0,'L',$fill);
        
    }
    $pdf->Ln();
        $fill = !$fill;
}





// Générer le PDF et l'envoyer au navigateur
$pdf->Output();
?>


<?php
// require('libs/alphafpdf.php');
// // Connexion à la base de données
// $servername = "localhost";
// $username = "black"; // Remplacez par votre nom d'utilisateur MySQL
// $password = "black"; // Remplacez par votre mot de passe MySQL
// $dbname = "boutique"; // Remplacez par le nom de votre base de données

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Vérifier la connexion
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // $pdf = new PDF('L'); // 'L' indique l'orientation paysage
// // $pdf->SetFont('Arial','',12); // Réduire la taille de la police
// // $pdf->AddPage();

// // Titres des colonnes


// // Requête pour récupérer les données de la table produit
// $sql = "SELECT * FROM produit";
// $result = $conn->query($sql);

// $data = array();
// if ($result->num_rows > 0) {
//     // Récupérer chaque ligne de données
//     while($row = $result->fetch_assoc()) {
//         $data[] = array($row["nomProd"],  $row["image"], $row["poid"], $row["prixU"], $row["prixV"], $row["dateAjout"]);
//     }
// } else {
//     echo "0 results";
// }

// $conn->close();



// $pdf = new AlphaPDF('L');

// $pdf->AddPage();

// // Filigrane "Lenora"
// $pdf->SetTextColor(128); // Définit la couleur du texte en gris
// $pdf->SetAlpha(0.5); // Définit la transparence alpha à 0.3 (30% de transparence)
// $pdf->SetFont('Arial', '', 150); // Définit la taille de la police à 90 points
// $pdf->Text(60, 80, 'Lenora'); // Affiche le texte "Lenora" aux coordonnées (60,80)
// $pdf->SetAlpha(1); // Rétablit la pleine opacité


// $pdf->SetFont('Arial','',12); // Réduire la taille de la police
// $pdf->SetLineWidth(1.5);


// $header = array('NomProd', 'Image','Poids','PrixU','PrixV','DateAjout');





// // En-tête du tableau
// // $pdf->SetFont('Arial', 'i', $fontSize);
// // $pdf->SetFillColor(150, 150, 150); // Couleur de fond de l'en-tête
// $maxWidths = array();
//         foreach ($header as $col) {
//             $maxWidths[] = $pdf->GetStringWidth($col) + 4; // Ajouter un padding de 6 pour chaque colonne
//         }
//         foreach ($data as $row) {
//             foreach ($row as $key => $col) {
//                 $colWidth = $pdf->GetStringWidth($col) + 4;
//                 if ($colWidth > $maxWidths[$key]) {
//                     $maxWidths[$key] = $colWidth;
//                 }
//             }
//         }
        
//         // En-tête
//         for ($i = 0; $i < count($header); $i++) {
//             $pdf->Cell($maxWidths[$i], 10, $header[$i], 1);
//         }
//         $pdf->Ln();

// // Données du tableau
// // $pdf->SetFont('Arial', '', $fontSize);
// // $pdf->SetFillColor(255, 255, 255); // Couleur de fond des cellules de données
// foreach ($data as $row) {
//     for ($i = 0; $i < count($row); $i++) {
//         $pdf->Cell($maxWidths[$i], 6, $row[$i], 1);
//     }
//     $pdf->Ln();
// }




// // Générer le PDF et l'envoyer au navigateur
// $pdf->Output();
?>


<?php
// require('libs/alphafpdf.php');

// $pdf = new AlphaPDF();
// $pdf->AddPage();
// $pdf->SetLineWidth(1.5);

// $header = array('Pays', 'Capitale', 'Superficie (km²)', 'Pop. (milliers)');
// $data = array(
//     array('France', 'Paris', '551695', '67081000'),
//     array('Germany', 'Berlin', '357022', '83149300'),
//     array('Italy', 'Rome', '301340', '60483973'),
//     array('Spain', 'Madrid', '505990', '46754778')
// );

// $cellWidth = 40;
// $cellHeight = 10;
// $fontSize = 12;

// // En-tête du tableau
// $pdf->SetFont('Arial', 'B', $fontSize);
// $pdf->SetFillColor(192, 192, 192); // Couleur de fond de l'en-tête
// foreach ($header as $col)
//     $pdf->Cell($cellWidth, $cellHeight, $col, 1, 0, 'C', true);
// $pdf->Ln();

// // Données du tableau
// $pdf->SetFont('Arial', '', $fontSize);
// $pdf->SetFillColor(255, 255, 255); // Couleur de fond des cellules de données
// foreach ($data as $row) {
//     foreach ($row as $col)
//         $pdf->Cell($cellWidth, $cellHeight, $col, 1, 0, 'C', true);
//     $pdf->Ln();
// }

// // Filigrane "Lenora"
// $pdf->SetTextColor(128); // Définit la couleur du texte en gris
// $pdf->SetAlpha(0.3); // Définit la transparence alpha à 0.3 (30% de transparence)
// $pdf->SetFont('Arial', '', 90); // Définit la taille de la police à 90 points
// $pdf->Text(60, 80, 'Lenora'); // Affiche le texte "Lenora" aux coordonnées (60,80)
// $pdf->SetAlpha(1); // Rétablit la pleine opacité

// // Générer le PDF et l'envoyer au navigateur
// $pdf->Output();
?>