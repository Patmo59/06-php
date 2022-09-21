<?php 
/* Quelques conventions :
    1. Quand on place toute notre logique PHP dans le même fichier que notre HTML.
        On placera souvent toute la logique PHP en haut du fichier, avant le moindre HTML.
    2. On aura tendance à déclarer toute les variables que l'on va utiliser en haut de notre code pour s'en souvenir et pouvoir les modifier facilement sans recherche. 
*/
// On va déclarer une variable pour chaque input de notre formulaire.
$username = $food = $drink = "";
// ainsi qu'une variable qui est un tableau qui contiendra nos erreurs.
$error = [];
// Optionnellement, je vais créer des tableaux qui seront utiles pour la vérification de nos champs à choix limité. (radio, select)
$foodList = ["welsh", "cannelloni", "oyakodon"];
$drinkList = ["jus de tomate", "milkshake", "limonade"];
// On trouvera dans la superglobal $_SERVER, la méthode avec laquelle la page a été requis.
// var_dump($_SERVER["REQUEST_METHOD"]);
// par défaut, quand on va de page en page, on est en méthode GET.

/*
    Lorsque l'on veut regarder le contenu d'un formulaire envoyé en méthode GET, On va vérifier deux choses :
        1. Si on est bien arrivé en méthode GET sur la page.
        2. Si notre formulaire a bien été soumis.
*/
if($_SERVER["REQUEST_METHOD"] == "GET" 
    && isset($_GET["submit"])){
        // Ensuite on va vérifier si tous nos inputs "requis"
        if(!empty($_GET["username"])){
            /*
                L'utilisateur peut entrer des informations malveillante, par exemple un script ou un lien vers un autre site. 
                Pour éviter cela il est important de nettoyer les entrés de l'utilisateur.
                histoire de ne pas se répéter pour chaque champs, on aura déclaré une fonction qui fait ce travail.
                ! Règle de développeur :
                ! "Don't trust user !"
            */
            $username = cleanData($_GET["username"]);
            /* Généralement on enregistrera notre username 
            en bdd sous la forme d'un varchar() celui prend une taille maximum, il faudra donc vérifier que le nom de l'utilisateur ne dépasse pas cette taille. 
            voir qu'il ai aussi une taille minimum.*/
            if(strlen($username)<3 || strlen($username)>30){
                $error["username"] = "Votre nom d'utilisateur n'a pas une taille adapté";
            }
        }
        else{
            $error["username"] = "Veuillez entrer un nom d'utilisateur";
        }
        if(!empty($_GET["food"])){
            $food = cleanData($_GET["food"]);
            /* On ne voudrait pas que l'utilisateur rentre des 
            informations qui ne correspondent pas à celles que l'on propose. donc on va vérifier si l'information envoyé est bien dans notre tableau. */
            if(!in_array($food, $foodList)){
                $error["food"] = "Ce repas n'existe pas !";
            }
        }
        else{
            $error["food"] = "Veuillez choisir un repas";
        }
        if(!empty($_GET["drink"])){
            $drink = cleanData($_GET["drink"]);
            if(!in_array($drink, $drinkList)){
                $error["drink"] = "Cette boisson n'existe pas !";
            }
        }
        else{
            $error["drink"] = "Veuillez choisir une boisson";
        }
    }
function cleanData(string $data):string{
    // trim va venir supprimer les espaces en début et fin du string.
    $data = trim($data);
    // stripslashes va venir supprimer les "\" afin d'éviter que des caractères soit échapé.
    $data = stripslashes($data);
    // htmlspecialchars va convertir les caractères spéciaux en entité html.
    return htmlspecialchars($data);
    // exemple : "<" devient "&lt;"
}
/*
    Il existe d'autres façon de nettoyer les entrées de l'utilisateur.
    Mais quoi qu'il arrive, ne testez pas uniquement ce qui doit fonctionner, mais aussi, ce qui ne doit pas fonctionner.
*/
$title = " GET ";
$headerTitle = "Formulaire en GET";
require("../ressources/template/_header.php");
?>
<!-- l'attribut action, permet d'indiquer vers quel page
rediriger l'utilisateur pour traiter le formulaire.
Si on le laisse vide, il rechargera uniquement la page. 
L'attribut method permet d'indiquer avec quelle méthode 
les données seront transféré, généralement en GET ou en POST-->
<form action="" method="GET">
    <!-- quand on veut traiter un formulaire, il est important de ne pas oublier l'attribut "name" il permettra de récupérer les informations. -->
    <input type="text" placeholder="Entrez un nom" name="username">
    <!-- les span.error serviront à afficher nos messages d'erreur. -->
    <span class="error"><?php echo $error["username"]??"" ?></span>
    <br>
    <fieldset>
        <legend>Nourriture Favorite</legend>
        <input type="radio" name="food" id="welsh" value="welsh">
        <label for="welsh">Welsh (car vive le fromage)</label>
        <br>
        <input type="radio" name="food" id="cannelloni" value="cannelloni">
        <label for="cannelloni">Cannelloni (car les ravioli c'est surfait)</label>
        <br>
        <input type="radio" name="food" id="oyakodon" value="oyakodon">
        <label for="oyakodon">Oyakodon (car j'aime l'humour noir)</label>
        <br>
        <span class="error"><?php echo $error["food"]??"" ?></span>
    </fieldset>
    <label for="boisson">Boisson Favorite</label>
    <br>
    <select name="drink" id="boisson">
        <option value="jus de tomate">Jus de tomate (je suis un vampire</option>
        <option value="milkshake">Milkshake (aux fruits de préférence)</option>
        <option value="limonade">Limonade (j'ai besoin de sucre)</option>
    </select>
    <span class="error"><?php echo $error["drink"]??"" ?></span>
    <br>
    <!-- J'ai ajouté un "name" au bouton submit afin de vérifier
    si c'est le bon formulaire qui a été soumis. -->
    <input type="submit" value="Envoyer" name="submit">
</form>
<!-- La zone suivante aura pour rôle d'afficher le résultat du 
formulaire. 
empty() va vérifier si la variable fourni en argument est vide
isset($_GET["submit"]) va vérifier si dans les informations 
fourni en get se trouve une clef "submit" -->
<?php if(empty($error) && isset($_GET["submit"])): ?>
    <h1>Meilleur repas :</h1>
    <p>
        <?php echo "Pour $username, le meilleur repas est \"$food\" avec \"$drink\".";?>
    </p>
<?php endif; ?>
<?php 
require("../ressources/template/_footer.php");
?>