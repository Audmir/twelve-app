<?php
include "config.php";

$numero_chassie = htmlspecialchars($_POST['num_ch']);
$annee_de_fabrication = htmlspecialchars($_POST['annee_fab']);
$marque = htmlspecialchars($_POST['marque']);
$nombre_de_roue = htmlspecialchars($_POST['nombre_roue']);
$origine = htmlspecialchars($_POST['pays_orig']);
$nombre_de_porte = htmlspecialchars($_POST['nombre_de_porte']);
$plaque = htmlspecialchars($_POST['plaque']);
$modele = htmlspecialchars($_POST['modele']);
$couleur = htmlspecialchars($_POST['couleur']);
$categorie = htmlspecialchars($_POST['categorie']);
$declaration = htmlspecialchars($_POST['declaration']);

$chauffeur_id = rand(100000, 1000000);
$proprietaire_id = rand(100000, 1000000);

$photo = $_FILES['photo']['name'];
$photo_tmp = $_FILES['photo']['tmp_name'];
$photo_size = $_FILES['photo']['size'];
$link = "../upload/" . $photo;

if (
    !empty($numero_chassie) || !empty($annee_de_fabrication) || !empty($marque) || !empty($nombre_de_roue)
    || !empty($origine) || !empty($nombre_de_porte) || !empty($plaque) || !empty($modele) || !empty($couleur) || !empty($categorie)
) {

    $query = $conn->prepare("INSERT INTO engine_identity(`numero_du_chassi`,`annee_de_fabrication`,`marque`,`nombre_de_roue`,`couleur`,`pays_originaire`,`nombre_de_portes`,`plaque_imatriculation`,`modele`,`categorie`,`proprietaire_id`,`chauffeur_id`,`photo`,`declaration`)
     VALUES('$numero_chassie','$annee_de_fabrication','$marque','$nombre_de_roue','$couleur','$origine','$nombre_de_porte','$plaque','$modele','$categorie','$proprietaire_id','$chauffeur_id','$photo','$declaration')");
    if ($query->execute()) {
        if (move_uploaded_file($photo_tmp, $link)) {
            try {
                $query2 = $conn->prepare("SELECT proprietaire_id, chauffeur_id, id FROM engine_identity WHERE numero_du_chassi = '$numero_chassie'");
                $query2->execute();
                $res = $query2->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                    foreach ($res as $row) {
                        header("Location: ../pages/forms/basic_elements?proprietaire_id=$row[proprietaire_id]&chauffeur_id=$row[chauffeur_id]&id=$row[id]");
                    }
                }
            } catch (PDOException $e) {
                throw ($e);
            }
        } else {
            echo "Une erreur s'est produit lors la publication";
        }
    }
} else {
    echo "Remplissez tous les champs s'il vous plaît";
}
