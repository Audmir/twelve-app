<?php 
    session_start();
    setcookie("unique_id", $_COOKIE['unique_id'] , time()-0, "/");
    unset($_SESSION['unique_id']);
    session_destroy();
    header('Location:../index');
?>