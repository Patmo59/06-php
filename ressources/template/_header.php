<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Si j'ai une balise "$title" j'affiche son contenu à la 
    suite de mon title, sinon je n'affiche rien. -->
    <title>Cours PHP <?php echo $title??"" ?></title>
    <!-- ATTENTION ! Lorsque vous faites de l'inclusion.
    Le lien se fait depuis le fichier qui inclus, et non 
    depuis le fichier à inclure. -->
    <!-- <link rel="stylesheet" href="./ressources/style/style.css"> -->
    <!-- Le précédent fonctionne, mais pas le suivant. -->
    <!-- <link rel="stylesheet" href="../style/style.css"> -->
    <link rel="stylesheet" href="/ressources/style/style.css">
    <script src="/ressources/style/script.js" defer></script>

</head>
<body>
    <header>
        <!-- Si j'ai une variable "$headerTitle" j'affiche
        son contenu, sinon j'affiche "Syntaxes" en tant que h1-->
        <h1><?php echo $headerTitle??"Syntaxes" ?></h1>
    </header>
    <!-- Si j'ai une variable "$mainClass" j'affiche
    son contenu en tant que classe sinon je n'affiche rien -->
    <main class="<?php echo $mainClass??"" ?>">

    <!-- J'ai retiré les balises de fin
    afin de les placers dans le fichier "_footer.php" -->