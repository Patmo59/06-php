<?php 
/*
    Dans PHP il existe plusieurs outils de connexion à une BDD.
    Les deux plus utilisés sont "MySQLi" et "PDO"
        (Attention lors de vos recherches, dans le passé il y avait un outil MySQL mais qui est maintenant obsolète)
    MySQLi est adapté uniquement aux BDD avec un pilote MySQL.
    PDO lui est adapté à n'importe quel Pilote
    PDO signifie "PHP Data Object"
*/
function connexionPDO(): PDO{
    /* 
        Grâce au return dans le fichier requis, je peux récupèrer 
        le tableau qu'il contient dans une variable.
    */
    $config = require __DIR__ ."/../config/_blogConfig.php";
    /* 
        DSN signifie "Data Source Name" c'est un string contenant 
        toute les informations pour localiser la BDD.
        elle prendra la forme suivante :
            "pilote":host="hebergeur";port="port de la bdd";dbname="nom de la bdd";charset="charset utilisé par la bdd"
            Le tout sans espace, en remplaçant les parties entre guillemet par les valeurs appropriées.
        exemple :
            mysql:host=localhost;port=3306;dbname=blog;charset=utf8mb4
    */
    $dsn = 
        "mysql:host=".$config["host"]
        .";dbname=".$config["database"]
        .";charset=".$config["charset"];
    try{
        /* 
            On crée une nouvelle instance de "PDO" en lui donnant
                le DSN en premier argument,
                le nom d'utilisateur en second,
                le mot de passe en troisième,
                ses options en quatrième.
        */
        $pdo = new PDO(
            $dsn,
            $config["user"],
            $config["password"],
            $config["options"]
        );
        // On retourne notre nouvel objet PDO.
        return $pdo;
    }catch(PDOException $e){
        /* 
            On capture l'erreur sous forme de PDOException,
            Puis on la lance (throw) avec le message capturé en premier argument
            et le code d'erreur en second.
        */
        throw new PDOException(
            $e->getMessage(), 
            (int)$e->getCode()
        );
    }
}
/* 
    Profitons d'avoir un fichier importé dans tous nos formulaires
    pour y ajouter une fonction que l'on utilise aussi dans tous nos formulaires.
*/
function cleanData(string $data): string{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}
?>