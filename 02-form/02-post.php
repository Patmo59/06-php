<?php 
/* 
    Les seules différences de traitement entre un formulaire en GET et un en POST
    sont :
        1. La vérification qu'on arrive en méthode "POST" et non "GET"
        2. l'attribut méthod du formulaire qui devient "POST"
        3. l'utilisation de $_POST au lieu de $_GET.
Mais histoire de ne pas s'arrêter ici,
    Améliorons notre formulaire.
    TODO : Ajoutons une checkbox cgu par exemple.
    TODO : Ajoutons aussi des classes en cas d'erreur.
    Et améliorons nos inputs select et radio.
*/
$username = $food = $drink = "";
$error = [];
$foodList = [
    "welsh"=>"Welsh (car vive le fromage)",
     "cannelloni"=>"Cannelloni (car les ravioli c'est surfait)",
      "oyakodon"=>"Oyakodon (car j'aime l'humour noir)"
    ];
$drinkList = [
    "jus de tomate"=>"Jus de tomate (je suis un vampire)",
     "milkshake"=>"Milkshake (aux fruits de préférence)",
      "limonade"=> "Limonade (j'ai besoin de sucre)"
    ];

if($_SERVER["REQUEST_METHOD"] == "POST" 
    && isset($_POST["submit"])){
        if(!empty($_POST["username"])){
            $username = cleanData($_POST["username"]);
            if(strlen($username)<3 || strlen($username)>30){
                $error["username"] = "Votre nom d'utilisateur n'a pas une taille adapté";
            }
        }
        else{
            $error["username"] = "Veuillez entrer un nom d'utilisateur";
        }
        if(!empty($_POST["food"])){
            $food = cleanData($_POST["food"]);
            /* 
            Nos tableaux étant devenu des tableaux associatif, on vérifie la présence des clefs et non plus des valeurs. on remplace donc "in_array" par "array_key_exists"
            */
            if(!array_key_exists($food, $foodList)){
                $error["food"] = "Ce repas n'existe pas !";
            }
        }
        else{
            $error["food"] = "Veuillez choisir un repas";
        }
        if(!empty($_POST["drink"])){
            $drink = cleanData($_POST["drink"]);
            if(!array_key_exists($drink, $drinkList)){
                $error["drink"] = "Cette boisson n'existe pas !";
            }
        }
        else{
            $error["drink"] = "Veuillez choisir une boisson";
        }
        // Le champ est il vide?
        if(!empty($_POST["cgu"])){
            $cgu = $_POST["cgu"];
            // une seule valeur possible, on peut la vérifier directement
            if($cgu != "cgu"){
                // à noter que la valeur d'une checkbox ou radio si elle n'est pas défini vaut "on";
                $error["cgu"] = "Ne modifiez pas nos formulaires !";
            }
        }
        else{
            $error["cgu"] = "Veuillez cocher la case.";
        }
    }
function cleanData(string $data):string{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}
$title = " POST ";
$headerTitle = "Formulaire en POST";
require("../ressources/template/_header.php");
?>
<form action="" method="POST">
    <input 
        type="text" 
        placeholder="Entrez un nom" 
        name="username"
        class="<?php echo (empty($error["username"])?"":"formError") ?>"
        value="<?php echo $username ?>">
    <span class="error"><?php echo $error["username"]??"" ?></span>
    <br>
    <fieldset class="<?php echo (empty($error["food"])?"":"formError") ?>">
        <legend>Nourriture Favorite</legend>
        <?php foreach($foodList as $k => $f): ?>
            <input 
                type="radio" 
                name="food" 
                id="<?php echo $k ?>" 
                value="<?php echo $k ?>"
                <?php echo $food === $k ? "checked":""; ?>
            >
            <!-- Si notre variable $food est égale à l'itération
            actuelle, alors on lui ajoute l'attribut "checked" -->
            <label for="<?php echo $k ?>">
                <?php echo $f ?>
            </label>
            <br>
        <?php endforeach; ?>
        <span class="error"><?php echo $error["food"]??"" ?></span>
    </fieldset>
    <label for="boisson">Boisson Favorite</label>
    <br>
    <select name="drink" id="boisson">
        <?php foreach($drinkList as $k => $d): ?>
            <option 
                value="<?php echo $k ?>"
                <?php echo ($drink === $k?"selected":"") ?>
            >
                <?php echo $d ?>
            </option>    
        <?php endforeach; ?>
    </select>
    <span class="error"><?php echo $error["drink"]??"" ?></span>
    <br>
    <!-- On ajoute une checkbox "cgu" -->
    <input type="checkbox" name="cgu" id="cgu" value="cgu">
    <label for="cgu">J'accepte que mes données ne m'appartiennent plus.</label>
    <span class="error"><?php echo $error["cgu"]??"" ?></span>
    <!-- fin checkbox -->
    <input type="submit" value="Envoyer" name="submit">
</form>
<?php if(empty($error) && isset($_POST["submit"])): ?>
    <h1>Meilleur repas :</h1>
    <p>
        <?php echo "Pour $username, le meilleur repas est \"$food\" avec \"$drink\".";?>
    </p>
<?php endif; ?>
<?php 
require("../ressources/template/_footer.php");
?>