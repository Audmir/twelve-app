<?php
session_start();

include "./config.php";


$email = htmlspecialchars($_POST['mail']);
$password = htmlspecialchars($_POST['password']);

if (!empty($email) || !empty($password)) {

    $query = $conn->prepare("SELECT * FROM profile_admin WHERE email = '{$email}'");
    $query->execute();
    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    if (count($res) > 0) {
        foreach ($res as $row) {
            if ($row['password'] === $password) {

                $_SESSION['unique_id'] = $row['unique_id'];
                $_COOKIE['unique_id'] = "";

                setcookie("unique_id", "$_SESSION[unique_id]", time() + (86400 * 1), "/");
                if (isset($_SESSION['unique_id'])) {
                    echo "Success";
                } else {
                    echo "Erreur de gestion de cookies";
                }
            } else {
                echo "Mot de passe incorrecte!";
            }
        }
    } else {
        echo "pas de compte lié cet adresse mail. créer un compte s'il vous plît!";
    }
} else {
    echo "Remplissez tous les champs s'il vous plaît!";
}
