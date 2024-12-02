<?php
include "config.php";

$nom_complet = htmlspecialchars($_POST['nom_complet']);
$date_de_naissance = htmlspecialchars($_POST['dateN']);
$lieu_de_naissance = htmlspecialchars($_POST['LieuN']);
$adresse = htmlspecialchars($_POST['adress']);
$etat_civil = htmlspecialchars($_POST['etatC']);
$num  = htmlspecialchars($_POST['num']);
$mail = htmlspecialchars($_POST['mail']);

$photo_name = $_FILES['photo']['name'];
$photo_dir = $_FILES['photo']['tmp_name'];

$link = "../upload/" . $photo_name;

$prop_id = htmlspecialchars($_POST['prop_id']);

if (
    !empty($nom_complet) || !empty($date_de_naissance) || !empty($lieu_de_naissance) || !empty($adresse)
    || !empty($etat_civil) || !empty($num) || !empty($mail)
) {

    $query = $conn->prepare("INSERT INTO proprietaire(`proprietaire_id`,`nom_complet`,`data_de_naissance`,`Lieu_de_naissance`,`Adresse`,`Etat_civile`,`phone`,`email`,`photo`)
     VALUES('$prop_id','$nom_complet','$date_de_naissance','$lieu_de_naissance','$adresse','$etat_civil','$num','$mail','$photo_name')");

    if ($query->execute()) {
        if (move_uploaded_file($photo_dir, $link)) {
            echo "success";
        } else {
            echo "failed while uploading a photo";
        }
    } else {
        echo "une erreur s'est produit lors de l'enregistrement";
    }
} else {
    echo "Remplissez tous les champs s'il vous plaît!";
}
