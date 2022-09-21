<?php 
$headerTitle = $title = " Go To ";
require("../ressources/template/_header.php");
?>
<h1>Go to ?</h1>
<?php 
/*
goto permet de sauter une partie du code pour aller à
la suivante. On peut s'en servir avec une condition
pour ne pas faire certaines actions.
ou alors on peut s'en servir à la façon d'un break pour sortir
d'une boucle.
!Attention, on ne peut pas :
    Entrer dans une fonction, une boucle ou une condition avec goto.
    Sortir d'une fonction.
goto fonctionne en deux parties, la première est une balise
qui servira d'ancre à notre goto, c'est à dire l'endroit où aller.
    il est représenté par "unMot:"
et le mot clef "goto" suivi du nom d'une ancre.
*/
for ($i=0; $i < 100; $i++) { 
    echo "Ceci est le message $i ! <br>";
    if($i === 5){
        // On indique que l'on souhaite se rendre à l'ancre "fin"
        goto fin;
    }
}
echo "Les chaussettes de l'archi duchesse...";
// Ici on déclare notre ancre "fin"
fin:
echo "Ceci est la fin";
    require("../ressources/template/_footer.php")
?>