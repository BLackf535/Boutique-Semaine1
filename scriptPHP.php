
<?php
$servername = "localhost";
$username = "black";
$password = "black";
$dbname = "boutique";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

$term = $_GET["term"];

$sql = "SELECT * FROM produit WHERE nomProd LIKE '%" . $term . "%' order by nomProd asc limit 10";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'value' => $row["idProd"],
            'label' => $row["nomProd"]
        );
    }
}

echo json_encode($data);

$conn->close();
exit;
?>

