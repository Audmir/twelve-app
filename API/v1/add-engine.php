<?php
include "../config/config.php";
include "../config/set-up.php";
$method = $_SERVER['REQUEST_METHOD'];

$numero_du_chassi = htmlspecialchars($_GET['numero_chassi']);
$annee_de_fabrication = htmlspecialchars($_GET['annee_fab']);
$marque = htmlspecialchars($_GET['marque']);
$nombre_des_roues = htmlspecialchars($_GET['nombre_roues']);
$couleur = htmlspecialchars($_GET['couleur']);
$pays_originaire = htmlspecialchars($_GET['pay_orig']);
$nombre_de_portes = htmlspecialchars($_GET['nombre_portes']);
$plaque_dimmatriculation = htmlspecialchars($_GET['plaque']);
$modele = htmlspecialchars($_GET['modele']);
$categorie = htmlspecialchars($_GET['categorie']);
$propietaire_id = htmlspecialchars($_GET['prop_id']);
$chauffeur_id = htmlspecialchars($_GET['chauf_id']);

try {
    if ($method === "GET") {
        if (
            !empty($numero_du_chassi) || !empty($annee_de_fabrication) || !empty($marque)
            || !empty($nombre_des_roues) || !empty($couleur) || !empty($pays_originaire)
            || !empty($nombre_de_portes) || !empty($plaque_dimmatriculation) || !empty($modele)
            || !empty($categorie) || !empty($propietaire_id) || !empty($chauffeur_id)
        ) {

            $query = $conn->prepare("INSERT INTO engine_identity(`numero_du_chassi`,`annee_de_fabrication`,`marque`,`nombre_de_roue`,`couleur`,`pays_originaire`,`nombre_de_portes`,`plaque_imatriculation`,`modele`,`categorie`,`proprietaire_id`,`chauffeur_id`)
            VALUES('{$numero_du_chassi}','{$annee_de_fabrication}','{$marque}','{$nombre_des_roues}','{$couleur}','{$pays_originaire}','{$nombre_de_portes}','{$plaque_dimmatriculation}','{$modele}','{$categorie}','{$propietaire_id}','{$chauffeur_id}')");

            if ($query->execute()) {
                $data = [
                    'status' => 200,
                    'message' => "Ajoutée avec succès"
                ];
                echo json_encode($data);
                header("HTTP/1.0 200 Ajouté avec succès");
            } else {
                $data = [
                    'status' => 500,
                    'message' => "Erreur lors de l'ajout de la Engin"
                ];
                echo json_encode($data);
                header("HTTP/1.0 500 Error while saving data");
            }
        } else {
            $data = [
                'status' => 500,
                'message' => "Remplissez tous les champs s'il vous plaît"
            ];
            echo json_encode($data);
            header("HTTP/1.0 500 Please fill all fields");
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'This method is not allowed',
            'method' => $method
        ];
        echo json_encode($data);
        header("HTTP/1.0 This method is not allowed");
    }
} catch (PDOException $e) {
    $data = [
        'status' => 404,
        'message' => "Error while saving data",
        'error' => $e->getMessage()
    ];
    echo json_encode($data);
    header("HTTP/1.0 404 Error while saving data");
}
