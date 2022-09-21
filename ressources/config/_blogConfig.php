<?php 
/*
    Ce fichier va contenir toute les informations de connexion à votre BDD.
    Faites bien attention à ce qu'il ne soit pas accessible par vos utilisateurs sinon ils auront accès à votre BDD.
    Pour cela plusieurs possibilité, utiliser un routeur ou bien ranger ce fichier hors de la racine de votre site par exemple.
*/
return [
    // l'hebergeur de votre BDD
    "host" => "localhost",
    // Le nom de la BDD à laquelle on veut se connecter
    "database" => "blog",
    // l'username de connexion
    "user"=>"root",
    // le password de connexion
    "password"=>"",
    // le set de caractère utilisé par la BDD
    "charset"=>"utf8mb4",
    /* 
        Un tableau d'option qui seront utilisé pour indiquer à PDO (l'outil qu'on utilisera pour se connecter),
        comment réagir à certains cas.
    */
    "options"=>[
        // mode d'affichage des erreurs.
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        /* 
            Le mode de retour des données, ici on lui demande de 
            nous créer des tableaux associatif.
        */
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        /* 
            PDO peut émuler lui même les requêtes préparé plutôt 
            que de laisser le pilote de la BDD le faire.
            Notre version de MySQL gère très bien cela, on va donc désactiver celui de PDO.
        */
        PDO::ATTR_EMULATE_PREPARES => false
    ]
];
/* 
    Une liste des différents attributs pour ces options peut se retrouver ici :
        https://www.php.net/manual/fr/pdo.setattribute.php
    ainsi que les différents FETCH_MODE ici :
        https://www.php.net/manual/fr/pdostatement.fetch.php
*/
?>