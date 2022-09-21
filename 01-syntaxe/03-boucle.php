<?php
#------------------------------------------------------------------------
echo "<h1> While </h1><hr>";
// Les boucles permettent de répéter l'action qui se trouve entre accolade
$x = 0;
// tant que la condition entre parenthèse est "true", l'action sera répété.
while($x < 5){
    echo $x, "<br>";
    // Attention de bien avoir une condition de sortie de boucle.
    $x++;
    // Ici $x va augmenter jusqu'à ce que la condition devienne fausse.
}
// autres syntaxes :
while($x <10):
    echo $x, "<br>";
    $x++;
endwhile;
// syntaxe ne prenant qu'une seule instruction :
while($x<15) 
    echo $x++, "<br>";
#------------------------------------------------------------------------
echo "<h1>Do While </h1><hr>";
/* do while va effectuer au moins une fois l'action, avant de vérifier si il doit
la répéter. */
do{
    echo $x, "<br>";
    $x++;
    // Ici la condition retourne "false", l'action ne sera pas répété
}while($x<5);
//syntaxe ne prenant qu'une seule instruction.
do
    echo $x++, "<br>";
while($x<20);
#------------------------------------------------------------------------
echo "<h1>For</h1><hr>";
/*
    La boucle for est particulièrement adapté aux valeurs numériques.
    Elle est structuré ainsi :
        for(expr1; expr2; expr3){instruction à répéter}
        "expr1" sera évalué avant de commencer la boucle;
        "expr2" sera évalué au début de chaque itération et continuera la boucle si true;
        "expr3" sera évalué à la fin de chaque itération.
*/
for($y=0; $y<5; $y++){
    echo $y, "<br>";
}
// autres syntaxes :
for($y=0; $y<5; $y++):
    echo $y, "<br>";
endfor;
// une seule instruction.
for($y=0; $y<5; $y++)
    echo $y, "<br>";
#------------------------------------------------------------------------
echo "<h1>Foreach</h1><hr>";
$a = ["spaghetti", "thon", "mayonnaise", "oignon"];
// foreach permet d'itérer sur un tableau.
foreach($a as $food){
    // le nombre d'itération sera égale au nombre d'élément dans le tableau.
    /* à chaque itération, la variable défini après "as" se verra attribué 
    une nouvelle valeur du tableau.*/
    echo $food, "<br>";
}
// Il peut arriver que l'on souhaite récupérer la clef qui va avec la valeur.
# (surtout dans le cas d'un tableau associatif.)
foreach($a as $key => $food){
    echo "$key : $food <br>";
}
// autres syntaxes :
foreach($a as $food):
    echo $food, "<br>";
endforeach;
// une seule instruction :
foreach($a as $food)
    echo $food, "<br>";
#------------------------------------------------------------------------
echo "<h1>continue et break</h1><hr>";
foreach($a as $food){
    // continue met fin à l'itération actuelle et passe à la suivante.
    if($food === "spaghetti") continue;
    // break let fin à la boucle.
    if($food === "mayonnaise") break;
    echo $food, "<br>";
}
// Cet exemple se trouve dans un foreach mais continue et break sont utilisable dans toute les boucles.
?>