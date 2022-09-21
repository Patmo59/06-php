<?php
/* 
    Include et Require permettent d'inclure d'autres fichiers
    dans notre code. 
    Dans un dossier "ressources", nous allons créer 
    un dossier "template" avec les fichiers suivants :
        "_header.php";
        "_footer.php";
        "_nav.php";
    Puis toujours dans notre dossier ressources, on va
    créer un dossier style avec un fichier "style.css";

    Cette façon de nommer les fichiers avec un "_" en début
    est une convention indiquant que c'est un fichier qui ne doit pas chargé seul.
    C'est seulement un composant, une partie de quelque chose d'autre.
*/
$title = "- Include";
$headerTitle = "Include et Require";
$mainClass = "includeNav";
require("../ressources/template/_header.php");
/* 
    La principale différence entre require et include
    est le niveau d'erreur retourné. 
    include provoquera un warning, mais continuera 
    d'afficher le reste de votre page.
    require provoquera une fatal error, et votre page 
    ne sera pas affiché.
*/
include("../ressources/template/_nav.php");
?>
<div>
    <p id="para1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed sit laborum reprehenderit? Quia quibusdam at quisquam molestiae, optio quos perferendis in voluptatibus atque dolore deserunt ipsam commodi similique voluptas nesciunt.</p>
    <p id="para2">Sit, quia quibusdam similique reiciendis velit ab maxime, obcaecati nemo a culpa perferendis labore necessitatibus dignissimos maiores dolores porro ipsam. Soluta quas amet optio molestiae fuga maiores dolorum perferendis dolorem.</p>
    <p id="para3">Unde quasi perspiciatis voluptas suscipit maiores iusto laboriosam molestias nulla placeat minima nesciunt doloribus voluptatem, vero sunt rem. Minus neque quasi rem maxime est sed alias vel, temporibus nostrum non.</p>
    <p id="para4">Dolores odio quaerat voluptas itaque eos. Corporis nobis aliquid, est accusantium aspernatur impedit repellat reiciendis incidunt dolores saepe itaque asperiores. Quaerat aliquam ad atque asperiores magnam minima sapiente repudiandae neque.</p>
    <p id="para5">Nulla ab quam illum modi qui voluptas accusamus facilis iusto fugit totam impedit quia, maiores nostrum ad vel quibusdam provident saepe rerum amet sunt unde magni aliquam aperiam distinctio. Ea.</p>
</div>
<?php 

// require("../ressources/template/_footer.php");
// require("../ressources/template/_footer.php");
require_once("../ressources/template/_footer.php");
/*
require_once et include_once vont avant d'inclure 
un fichier, vérifier si il n'a pas déjà été inclus.
Si il est déjà inclus, il ne l'incluera pas.
*/
?>