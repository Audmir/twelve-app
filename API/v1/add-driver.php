<?php
include "../config/config.php";
include "../config/set-up.php";
$method = $_SERVER['REQUEST_METHOD'];

$chauffeur_id = htmlspecialchars($_GET['chauf_id']);
$nom_complet = htmlspecialchars($_GET['nom_compl']);
$date_de_naissance = htmlspecialchars($_GET['data_naiss']);
$Lieu_de_naissance = htmlspecialchars($_GET['lieu_naiss']);
$adresse = htmlspecialchars($_GET['adress']);
$etat_civil = htmlspecialchars($_GET['etat_civil']);
$phone = htmlspecialchars($_GET['phone']);
$email = htmlspecialchars($_GET['email']);
$photo = htmlspecialchars($_GET['photo']);

try {

    if ($method === "GET") {
        if (
            !empty($chauffeur_id) || !empty($nom_complet) || !empty($date_de_naissance) ||
            !empty($Lieu_de_naissance) || !empty($adresse) || !empty($etat_civil) || !empty($phone) ||
            !empty($email) || !empty($photo)
        ) {

            $query = $conn->prepare("INSERT INTO chauffeur(`chauffeur_id`,`nom_complet`,`data_de_naissance`,
            `Lieu_de_naissance`,`Adresse`,`Etat_civile`,`phone`,`email`,`photo`)
            VALUES('{$chauffeur_id}','{$nom_complet}', '{$date_de_naissance}', '{$Lieu_de_naissance}',
            '{$adresse}', '{$etat_civil}', '{$phone}', '{$email}', '{$photo}')");
            if ($query->execute()) {
                $data = [
                    'status' => 200,
                    'message' => "Ajouté avec succès"
                ];
                echo json_encode($data);
                header("HTT¨P/1.0 200 Data inserted successfully");
            } else {
                $data = [
                    'status' => 404,
                    'message' => "Failed to save data"
                ];
                header("HTTP/1.0 404 Failed to save data");
            }
        } else {
            $data = [
                'status' => 500,
                'message' => "Remplissez tous les champs s'il vous plaît"
            ];
            echo json_encode($data);
            header("HTT¨P/1.0 500 Please fill all fields");
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'This method is not allowed',
            'method' => $method
        ];
        echo json_encode($data);
        header("HTTP/1.0 500 this method is not allowed");
    }
} catch (PDOException $e) {
    $data = [
        'status' => 404,
        'message' => "Failed to save data",
        'error' => $e->getMessage()
    ];
    echo json_encode($data);
    header("HTTP/1.0 404 Failed to save data");
}

/* $sql = "UPDATE chauffeurs SET nom_complet = '$nom_complet', date_de_naissance = '$date_de_naissance', lieu_de_naissance = '$Lieu_de_naissance', adresse = '$adresse', etat_civil = '$etat_civil', phone = '$phone', email = '$email', photo = '$photo' WHERE id = '$chauffeur */
