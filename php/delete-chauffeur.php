<?php
include "config.php";
$id = $_GET['id'];

$query = $conn->prepare("SELECT * FROM chauffeur WHERE id = $id");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if (count($res) > 0) {
    foreach ($res as $row) {
        unlink("../upload/".$row['photo']);
        $query2 = $conn->prepare("DELETE FROM chauffeur WHERE id = $id");
        if ($query2->execute()) {
            header("Location: ../pages/tables/driver");
        } else {
            echo "L'erreur s'est produit lors de la suppression";
        }
    }
}
