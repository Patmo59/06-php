<?php
/*
 Le header dont on parle ici est l'entête de la requête 
 qui voyage entre le serveur et le navigateur.
 Pour la modifier on utilisera la fonction "header()"
 Généralement on doit utiliser le header avant d'afficher 
 du html.
*/
/* 
    "HTTP/" va permettre de modifier le code de status
    envoyé par le serveur. 
    Ici nous avons indiqué que notre page est un 404.
*/
header("HTTP/1.1 404 Not Found");
// http_response_code permet d'avoir le code de status
// echo http_response_code();
/* 
"Location:" permet de créer des redirections.
On le fera suivre d'un lien relatif ou absolu
et le code de status changera en 302.
*/
if(rand(0,100)<50){
    header("Location: 09-b-header.php");
    exit;
    /* "exit" met fin à l'execution du script, à partir 
    de ce mot clef le reste du code n'aura pas lieu.
    
    Ici on l'utilise car après une redirection, il n'est sensé
    rien y avoir .
    
    Accessoirement, on peut donner un string en argument de exit
    pour qu'il l'affiche: exit("problème ici"); 
    
    Exit à un Alias sous le nom de "die"; */
}
$headerTitle = $title = " Header page 1";
require("../ressources/template/_header.php");
?>
<h1>Vous avez de la chance de pouvoir me voir</h1>
<?php
require("../ressources/template/_footer.php");
?>