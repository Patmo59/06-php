<?php
/*
    "refresh:" permet de raffraichir la page au bout de quelques 
    secondes. 
    Si on ajoute "url=" séparé par un ";"
    On indique à la page de faire une redirection au bout 
    de ces quelques secondes.
*/
header("refresh:5;url=09-a-header.php");
/* 
    header peut prendre en second argument un boolean 
    qui est par défaut à true.
    Celui ci indique si ce header doit remplacer le header précédent
    ou juste s'y ajouter.

    En troisième argument on pourra lui indiquer un code de status
    pour la requête. 
    Ce troisième argument ne peut être utilisé si le premier est vide.
*/
$headerTitle = $title = " Header page 2";
require("../ressources/template/_header.php");
?>
<h1>Bienvenue sur la page 2... temporairement</h1>
<?php
require("../ressources/template/_footer.php");
?>