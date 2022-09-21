<?php 
/* 
    Si aucune session n'existe, alors on en commence une
    session_status retourne l'état actuel de la session.
    PHP_SESSION_NONE signifie qu'aucune n'est lancé.
*/
if(session_status() === PHP_SESSION_NONE)
    session_start();
/*
    Si on a une date d'expiration à notre session
    On pourra vérifier ici si ils ne sont pas trop vieux.
*/
if(!isset($_SESSION["expire"]) || time() > $_SESSION["expire"]){
    unset($_SESSION);
    session_destroy();
    setcookie("PHPSESSID", "", time()-3600);
}
if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true){
    header("Location: /02-form/04-connexion.php");
    exit;
}
?>