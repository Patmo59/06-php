<?php 
    require("../../ressources/service/_isloggedV2.php");
    isLogged(true, "./connexion.php");
    unset($_SESSION);
    session_destroy();
    setcookie("PHPSESSID", "", time()-3600);
    header("Location: ./connexion.php");
    exit;
?>