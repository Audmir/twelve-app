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
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/login_and_sign.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h3>Se connecter</h3>
            <form action="#" id="formTT">
                <center>
                    <p id="errorMessage" style="color: red;"></p>
                </center>
                <div class="gg">
                    <div class="input1">
                        <label for="Email">Votre adresse mail</label>
                        <input type="text" name="mail" id="Email" placeholder="exemple@gmail.com">
                    </div>
                    <div class="input2">
                        <label for="psw">Votre mot de passe</label>
                        <div class="p">
                            <input type="password" name="password" id="psw" placeholder="***************">
                            <span><i class="fa fa-eye"></i></span>
                        </div>
                    </div>
                </div>
                <div class="parms">
                    <a href="#" style="text-decoration:none; color:blue;">mot de passe oublié?</a>
                </div>
                <button id="submitButton">Se connecter</button>
                <div class="parms">
                    <p>Pas encore eu un compte? <a href="sign-up" style="text-decoration:none; color:blue;">créer</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="./js/login.js"></script>
</body>

</html>