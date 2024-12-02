<?php
session_start();
// check if the session name and the cookie name are set. if true then keep redirecting me on my home page
$_COOKIE['unique_id'] = "";
try {
    if (isset($_SESSION['unique_id']) || $_COOKIE['unique_id']) {
        header('Location:index-2');
    } else {
        setcookie("unique_id", $_COOKIE['unique_id'], time() - 0, "/");
        unset($_SESSION['unique_id']);
        session_destroy();
    }
} catch (Exception $e) {
    echo "the variable not declared";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
    <link rel="stylesheet" href="./assets/css/login_and_sign.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h3>Créer un compte</h3>

            <form action="#" id="formTT">
                <center>
                    <p id="errorMessage" style="color: red;"></p>
                </center>
                <div class="profile">
                    <div class="pro">
                        <img src="./profile/user_icon_male.png" id="profile-pic"
                            style="width:50px; height:50px; border-radius:50%;object-fit:cover;border:1px solid #c0c0c0;" alt="">
                        <label for="photo"><i class="fa fa-plus"
                                style="background:#011cb4;padding:5px;border-radius:50%;color:#fff;margin-left:-20px;cursor:pointer;"></i></label>
                    </div>
                    <input type="file" name="profile" id="photo" accept=".png, .jpeg, jpg" hidden>
                </div>
                <div class="gg">
                    <div class="input1">
                        <label for="Email">Votre nom</label>
                        <input type="text" name="name" id="nom" placeholder="Ex: Audrey mirindi" required>
                    </div>
                    <div class="input1">
                        <label for="Email">Votre adresse mail</label>
                        <input type="text" name="email" id="Email" placeholder="exemple@gmail.com" required>
                    </div>
                    <div class="input2">
                        <label for="psw">Votre mot de passe</label>
                        <div class="p">
                            <input type="password" name="password" id="psw" placeholder="***************" required>
                            <span><i class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="input2">
                        <label for="psw">Confirmer mot de passe</label>
                        <div class="p">
                            <input type="password" name="confpassword" id="psw" placeholder="***************" required>
                            <span><i class="fa fa-eye"></i></span>
                        </div>
                    </div>
                </div>
                <button id="submitButton">Se connecter</button>
                <div class="parms">
                    <p>Déjà eu un compte? <a href="index" style="text-decoration:none; color:blue;">se connecter</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/profile.js"></script>
    <script src="./js/sign-up.js"></script>
</body>

</html>