<?php
$headerTitle = $title = " Session page 2";
require("../ressources/template/_header.php");
/* Si on a besoin de la session que sur de rare pages.
Autant ne pas l'activer pour rien et faire le session start 
uniquement là où on en a besoin. 
Si on contraire la majorité de votre site, a besoin de la session.
Alors une chose qui peut se voir, c'est de lancer le session start
dans un header inclu sur toute nos pages. 

Généralement comme l'indique son nom, la session prend fin lorsque
l'utilisateur ferme son navigateur.
Mais il est possible, d'augmenter sa durée de vie.
*/
session_start([
    // durée de vie du cookie en seconde (0 par défaut);
    "cookie_lifetime" =>3600
]);
var_dump($_SESSION);
echo "<br>";
/*
Attention la durée de vie du cookie n'est pas très précise
Le navigateur vérifie de temps en temps si certains cookies 
sont trop vieux et alors il les supprime.
*/
// echo $_SESSION["username"] . " aime la "
//     .$_SESSION["food"] . " et a "
//     .$_SESSION["age"] . " ans ! <br>";
/* Quand on utilise la session, il est plus prore de vérifier
qu'elle existe bien avant de l'utiliser : 
    isset() vérifie si la ou les variables existe.*/
if(isset(
    $_SESSION["username"], 
    $_SESSION["food"],
    $_SESSION["age"]
    )){
        echo $_SESSION["username"] . " aime la "
        .$_SESSION["food"] . " et a "
        .$_SESSION["age"] . " ans ! <br>";
    }
// Pour supprimer des informations, on continuera de gérer le tableau classiquement :
unset($_SESSION["food"]);
// Pour supprimer la session en entier :
session_destroy();
// Cela dit si au rechargement il n'y aura certes, plus rien, la superglobal $_SESSION est toujours utilisable jusque là:
var_dump($_SESSION);
// on pourra donc ajouter :
unset($_SESSION);
/* Même si l'identifiant de session ne correspond plus à aucune 
session existante, le cookie est toujours présent et échangé 
avec le navigateur de notre utilisateur. 
Pour supprimer un cookie, il faudra lui donner une durée 
de vie négative.*/
setcookie("PHPSESSID", "", time()-3600);
/* quand le navigateur fera son nettoyage, il verra que le cookie
a une date passée, et le supprimera. */
/* 
    Surtout utiliser quand on a plusieurs projet sous le même 
    nom de domaine. On a la possibilité, de changer le nom 
    de notre session.
    Pour cela, avant de faire le session start, on fera :
*/
session_name("USERSESSION");
session_start();
$_SESSION["legume"] = "carotte";
/* Si on regarde à nouveau les cookies que ce soit sur le navigateur ou dans le superglobal $_COOKIE, on verra 
qu'un second cookie a été créé, avec le nouveau nom utilisé et un identifiant différent.*/
echo "<br>";
var_dump($_SESSION);
?>
<hr>
<a href="./07-a-session.php">Page 1</a>
<?php
require("../ressources/template/_footer.php");
?>