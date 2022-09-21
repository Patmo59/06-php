<?php
$headerTitle = $title = " Session page 1";
require("../ressources/template/_header.php");
// lorsque l'on veut manipuler la session, il faudra commencer par lancer session_start();
session_start();
/*
    Cette fonction va commencer une nouvelle session ou en récupérer une qui existe déjà. 
    Pour savoir si une session existe déjà, PHP va regarder si il y a un cookie au nom de la session, contenant un identifiant.
    Sinon il va en créer un.
    Un cookie est une information qui est transférée à chaque échange avec le serveur.
    le navigateur envoi les cookies au serveur, et le serveur 
    les lui rend.
    Si jamais on a besoin de récupérer l'identifiant de la session. On pourra utiliser au choix :
*/
echo session_id(), "<br>";
var_dump($_COOKIE["PHPSESSID"]);
/* 
    Par défaut, le nom de la session est "PHPSESSID" on pourra 
    choisir de modifier ce nom. (voir page 2)

    Pour stocker ou récupérer des informations en session.
    On utilisera la variable superglobal "$_SESSION"
    qui n'est accessible qu'après un session_start();
    Cette variable est un tableau associatif classique.
*/
$_SESSION["food"] = "pizza";
$_SESSION["age"] = 54;
$_SESSION["username"] = "Maurice";
// allons voir en page 2
?>
<hr>
<a href="./07-b-session.php">Page 2</a>
<?php
require("../ressources/template/_footer.php");
?>