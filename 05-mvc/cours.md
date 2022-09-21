# La structure MVC #

Le MVC est une structure de création d'applications, logiciel et site web.  
Ce sigle signifie :
    - Model
    - View
    - Controller

Il sert à retrouver son code plus facilement en divisant son code en 3 parties distincte.  
Jusqu'ici on avait nos requêtes à la BDD, l'algorythme et le html dans un même fichier. Lorsque l'on voulait modifier quelque chose, il fallait fouillers dans des dizaines de ligne où se trouvait ce que l'on cherchait.

Le principe du MVC est donc d'avoir des :

    - "Controllers":  
        Des fichiers qui vont regrouper tout l'algorythme de nos pages et cela regroupé par un thème.
    - "Models" :  
        Des fichiers qui vont regrouper toutes les requêtes à la BDD, là aussi regroupé par un thème.
    - "Views" :  
        Des fichiers qui ne contiennent que l'affichage de notre page.

En MVC, les requêtes de l'utilisateur sont toute envoyé aux controlleurs, celui ci échange éventuellement des informations avec le model, et enfin on retourne la vue à l'utilisateur.

![Schéma MVC](../ressources/images/mvc.png)

## Blog version MVC ##

Ici nous allons reproduire le site de blog créé dans le cours sur le CRUD en version MVC.

### 1. routeur ###

Il serait possible de faire une structure MVC sans routeur.
Mais cela nous forcerais à avoir autant de controlleur que de page (ou alors d'avoir beaucoup d'information en GET).  
Ici le but est de regrouper par thème nos pages, donc nous allons améliorer notre routeur pour gérer le MVC.

    1. ".htacess", le même que dans le cours sur le routeur.
    2. "routes.php", ajout des controlleurs et fonctions.
    3. "index.php", appel des fonctions.

### 2. Notre premier model. ###

Créons un dossier "model" avec un fichier "userModel.php", Dans celui ci nous allons inclure notre fichier de connexion à la BDD avec PDO.

Comme indiqué précédement, les models servent à regrouper les requêtes à la BDD.  
Comme l'indique le nom du fichier (usermodel.php), ce model contiendra les requêtes liées aux utilisateur.

### 3. Nos premières vue. ###

Nous allons maintenant créer un dossier "view" qui contiendra un dossier "user" et dans ce dernier 4 fichiers : 
    - list.php
    - inscription.php
    - delete.php
    - update.php

Ces fichiers contiendrons uniquement le côté affichage de la page. le HTML et les echo de PHP.

### 3. Notre premier controller ###

Créons un dossier "controller" qui contiendra un fichier "userController.php".  

Dans ce dernier nous allons créer 4 fonctions qui vont représenter les 4 pages liés à nos utilisateurs.
Ces fonctions contiendrons tous les échanges avec le model, la logique algorithmique et l'inclusion de la vue.