<?php 
    /*
        Résumons ce que l'on a vu :
            1. Il est important de mettre le fichier contenant les informations de connexion à votre BDD, 
                Dans un dossier inaccessible aux utilisateurs.
            2. Au lieu de répéter à chaque fois la connexion à la BDD dans chaque fichier où vous en avez besoin,
                Le faire dans un fichier inclut sera plus pratique.
            3. Si des informations rentrés par l'utilisateur sont requise dans votre requête SQL, 
                Il faut faire une requête préparé. 
    */
// * Connexion :
$pdo = new PDO(
    "mysql:host=localhost;port=3306;dbname=biere;charset=utf8mb4",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // PDO::ATTR_EMULATE_PREPARES => false
    ]
);
// * Requête simple (non sécurisé) :
$sql = $pdo->query("SELECT * FROM couleur");
echo "<pre>". print_r($sql->fetchAll(), 1). "</pre><hr>";

// * Requête préparé (paramètre anonyme) :
$sql = $pdo->prepare("SELECT * FROM couleur WHERE NOM_COULEUR=?");
$sql->execute(["Blanche"]);
echo "<pre>". print_r($sql->fetch(), 1). "</pre><hr>";

// * Requête préparé (paramètre nommé) :
$sql = $pdo->prepare("SELECT * FROM couleur WHERE NOM_COULEUR= :col");
$sql->execute(["col"=>"Brune"]);
echo "<pre>". print_r($sql->fetch(), 1). "</pre><hr>";

/*
    Pour "execute" il n'y a que deux types possibles.
        * string ou NULL
    Parfois on a besoin de choses plus précises.

    Par exemple si on laisse activé l'émulation des requêtes préparé par PDO. On va avoir un problème si on execute un paramètre avec "LIMIT".
    Ce dernier n'accepte que des chiffres et execute transforme notre chiffre en string.

    Une autre façon de faire, est de lier les paramètres en utilisant les méthodes :
        * bindValue() ou bindParam()
    Elles ont l'avantage de pouvoir accepter plus de type sous la forme de constante :
        - PDO::PARAM_NULL
        - PDO::PARAM_BOOL
        - PDO::PARAM_INT
        - PDO::PARAM_STR
*/
$sql = $pdo->prepare("SELECT * FROM couleur LIMIT :lim");
// provoque une erreur si prepare emulé par PDO.
// $sql->execute(["lim"=>2]);
$sql->bindValue("lim", 2, PDO::PARAM_INT);
$sql->execute();
echo "<pre>". print_r($sql->fetchAll(), 1). "</pre><hr>";

/*
    Execute doit être appelé quand même, mais il doit être laissé vide. 
    Soit on paramètre via les bind, soit via execute mais pas les deux.

    * Différence entre bindValue et bindParam :
*/
$couleur = "Blanche";
$sql = $pdo->prepare("SELECT * FROM couleur WHERE NOM_COULEUR = :col");
$sql->bindValue("col", $couleur, PDO::PARAM_STR);
$couleur = "Ambrée";
$sql->execute();
echo "<pre>". print_r($sql->fetch(), 1). "</pre><hr>";
/*
    Au dessus, on nous répond "Blanche"
    En dessous, on nous répond "Ambrée"
    bindValue va lier la valeur de la variable.
    bindParam va lier la variable elle même.
    Donc dans le dernier cas, si la variable change avant l'execution, cela change le résultat.
*/
$couleur = "Blanche";
$sql = $pdo->prepare("SELECT * FROM couleur WHERE NOM_COULEUR = :col");
$sql->bindParam("col", $couleur, PDO::PARAM_STR);
$couleur = "Ambrée";
$sql->execute();
echo "<pre>". print_r($sql->fetch(), 1). "</pre><hr>";

?>