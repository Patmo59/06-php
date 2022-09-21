<?php
/*
    Par défaut, rand() retourne une valeur aléatoire entre 0 et getrandmax();
    mais on peut lui donner en argument, une valeur minimum et maximum (compris)
*/
$r = rand(0,100);
echo $r, "<br>";
#------------------------------------------------------------------------
echo "<h1> Conditions </h1><hr>";
if($r<50){
    // si la condition entre parenthèse est vrai, alors on fait ce qui se trouve entre accolade.
    echo "\$r est plus petit que 50. <br>";
}
elseif($r>50){
    /* On peut optionnellement ajouter des conditions supplémentaire qui seront 
    testé si la précédente est fausse, avec elseif. 
    Il peut y en avoir autant qu'on veut. */
    echo "\$r est plus grand que 50. <br>";
}
else{
    /* On peut optionnelement ajouter un else, qui s'effectuera, si toute les conditions
    précédentes sont fausses. */
    echo "\$r est égale à 50. <br>";
}
#------------------------------------------------------------------------
echo "<h1> Autres syntaxes </h1><hr>";
/*
    Bien que plus rare, il est possible d'écrire une condition en remplaçant les accolades,
    Elles seront remplacé par ":" en début de condition, et par "endif" à la fin.
    peu importe la présence de elseif ou else.
*/
if($r <50):
    echo "\$r est plus petit que 50. <br>";
elseif($r>50):
    echo "\$r est plus grand que 50. <br>";
else:
    echo "\$r est égale à 50. <br>";
endif;

/* 
    Cette syntaxe permet de raccourcir encore plus le code mais à pour contrainte
    de ne pouvoir recevoir qu'une seule instruction, sans accolade ni ":"
    seule l'instruction suivante sera effectué. 
*/
if($r <50)
    echo "\$r est plus petit que 50. <br>";
elseif($r>50)
    echo "\$r est plus grand que 50. <br>";
else
    echo "\$r est égale à 50. <br>";

/* 
    En cas de toute petite instruction, il est aussi possible de raccourcir
    nos conditions sous la fomre de ternaire :
    condition? true : false;
*/
echo "\$r est plus ". ($r<=50? "petit ou égale à": "grand que") . " 50 <br>";
// On peut aussi imbriquer plusieurs ternaires entre elles si on oublie pas les parenthèses.
echo "\$r est ". ($r<50? "plus petit que": ($r>50? "plus grand que":"égale à"))." 50.<br>";
// On peut souhaiter parfois afficher la valeur d'une variable qui est ou n'est pas défini. 
$message1 = "Bonjour tout le monde ! <br>";
echo $message1?? "rien à dire <br>";
echo $message2?? "rien à dire <br>";
#------------------------------------------------------------------------
echo "<h1> switch </h1><hr>";
$pays = ["France", "Japon", "Angleterre", "Suisse", "france"];
$r2 = rand(0, count($pays)-1);
echo $pays[$r2], "<br>";
// le switch permet de gérer des cas sans avoir à faire des if et elsif en boucle.
switch($pays[$r2]){
    // la valeur donné en argument sera évaluée et le cas correspondant sera effectué.
    case "Japon": 
        echo "Pays dont la cuisine est inscripte au patrimoine immateriel de l'UNESCO";
        // chaque cas doit finir par un break;
        break;
    case "Suisse":
        echo "Pays où tout le monde ne parle pas la même langue.";
        break;
    case "france":
        echo "met une majuscule ! <br>";
        // si il n'y a pas de break, le cas suivant sera aussi effectué.
    case "France":
        echo "Second pays dont la cuisine est au patrimoine immateriel de l'UNESCO";
        break;
    default:
        // si aucun cas ne correspond, ce sera default qui sera choisi.
        echo "Je ne vais pas détailler tous les pays";
}
// Le switch précédent équivaut à :
// echo "<br>";
// if($pays[$r2] == "Japon"){
//     echo "Pays dont la cuisine est inscripte au patrimoine immateriel de l'UNESCO";
// }
// elseif($pays[$r2] == "Suisse"){
//     echo "Pays où tout le monde ne parle pas la même langue.";
// }
// elseif($pays[$r2] == "france"){
//     echo "met une majuscule ! <br>";
// }
// if($pays[$r2] == "France" || $pays[$r2] == "france"){
//     echo "Second pays dont la cuisine est au patrimoine immateriel de l'UNESCO";
// }
// else{
//     echo "Je ne vais pas détailler tous les pays";
// }
?>