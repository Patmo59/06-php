<?php 
    /* 
        Cette page ne devrait être accessible qu'à un un utilisateur connecté. 
        Bloquer l'accès à une page aux gens non connecté est une action que l'on va souvent répéter.
        Donc plutôt que de réécrire le même code à chaque fois, autant faire un fichier qu'on va inclure.
    */
    require("../ressources/service/_islogged.php");
    unset($_SESSION);
    session_destroy();
    setcookie("PHPSESSID", "", time()-3600);
    /* 
        Notre connexion étant géré par la session, pour se déconnecter, 
        Il suffit de détruire la session.
        Puis on redirigera notre utilisateur ailleurs.
    */
    header("Location: ./04-connexion.php");
    exit;
?>