<?php

session_start();
include "./config.php";

$user_name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
$confirm_password = htmlspecialchars($_POST['confpassword']);

$image = $_FILES['profile']['tmp_name'];
$image_name = $_FILES['profile']['name'];

try {
    if (!empty($user_name) || !empty($email) || !empty($password) || !empty($confirm_password)) {
        if ($password === $confirm_password) {
            $query = $conn->prepare("SELECT * FROM profile_admin WHERE email = '$email'");
            $query->execute();
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            if (count($res) > 0) {
                echo "Il ya déjà un compte lié à cet adresse mail s'il vous plaît";
            } else {
                $unique_id = rand(100000, 10000000);
                if (!empty($image_name)) {
                    $new_name = rand(1000, 100000) . "_" . $image_name;
                    $new_dir = "profile/" . $new_name;

                    $query2 = $conn->prepare("INSERT INTO profile_admin(`unique_id`,`nom`,`email`,`password`,`profile_photo`)
                                                VALUES('{$unique_id}', '{$user_name}','{$email}','{$password}','{$new_dir}')");
                    if ($query2->execute()) {
                        if (move_uploaded_file($image, "../profile/" . $new_name)) {

                            $_SESSION['unique_id'] = $unique_id;
                            $_COOKIE['unique_id'] = "";

                            setcookie("unique_id", "$_SESSION[unique_id]", time() + (86400 * 1), "/");
                            if (isset($_SESSION['unique_id'])) {
                                echo "Success";
                            } else {
                                echo "Erreur de gestion de cookies";
                            }
                        } else {
                            echo "L'erreur s'est produit lors dela sauvegarde de l'image au serveur";
                        }
                    } else {
                        echo "L'erreur s'est produit lors de l'insertion dans la BD";
                    }
                } else {
                    $img_name = "profile/user_icon_male.png";
                    $query2 = $conn->prepare("INSERT INTO profile_admin(`unique_id`,`nom`,`email`,`password`,`profile_photo`)
                                                VALUES('{$unique_id}', '{$user_name}','{$email}','{$password}','{$img_name}')");
                    if ($query2->execute()) {
                        $_SESSION['unique_id'] = $unique_id;
                        $_COOKIE['unique_id'] = "";

                        setcookie("unique_id", "$_SESSION[unique_id]", time() + (86400 * 1), "/");
                        if (isset($_SESSION['unique_id'])) {
                            echo "Success";
                        } else {
                            echo "Erreur de gestion de cookies";
                        }
                    } else {
                        echo "L'erreur s'est produit lors de l'insertion dans la BD";
                    }
                }
            }
        } else {
            echo "Les mots de passe ne correspondent pas!";
        }
    } else {
        echo "Remplissez tous les champs s'il vous plaît!";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
