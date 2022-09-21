<!-- 
    ----------------------------Exercice D1------------------------------ 
    écrire une fonction "frenchDate" qui retournera la date du jour 
    en français, puis l'afficher (exemple : jeudi 25 août 2022);
-->
<?php 
function frenchDate(){
    $d = ["Dimanche","Lundi","Mardi","Mercredi","Jeudi",
            "Vendredi","Samedi"];
    $m = ["janvier","février","mars","avril","mai","juin",
            "juillet","août","septembre","octobre",
            "novembre","décembre"];
    $today = $d[date("N")];
    $month = $m[date("n")-1];
    $jour = date("j");
    $annee = date("Y");
    return "$today $jour $month $annee";
}
echo frenchDate();
?>
<hr>
<!-- 
    ----------------------------Exercice D2------------------------------ 
    Utiliser la fonction précédement créé pour afficher la date 
    puis l'heure depuis laquelle l'utilisateur visite le site.
    On utilisera les sessions.
-->
<?php 
session_start();
if(!isset($_SESSION["loggedAt"])){
    $_SESSION["loggedAt"] = frenchDate() . " ". date("H:i:s");
}
echo "Présent ici depuis : " . $_SESSION["loggedAt"];
?>
<hr>
<!-- 
    ----------------------------Exercice D3------------------------------ 
    Afficher depuis combien de seconde l'utilisateur est présent sur
     le site.
-->
<?php 
if(!isset($_SESSION["loggedSince"])){
    $_SESSION["loggedSince"] = time();
}
echo "Vous êtes ici depuis ". (time() - $_SESSION["loggedSince"])
    . " secondes";
?>