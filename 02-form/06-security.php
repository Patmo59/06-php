<?php 
/* 
    Une des attaques les plus communes est l'attaque "XSS"
    (Cross-Site Scripting) Elle consiste en l'execution de script 
    venant d'une source externe à votre site.
    La meilleur façon de s'en protéger est :
        ! "Don't trust users!"
    On s'en est déjà protégé grâce à l'assainissement des 
    entrées de l'utilisateur. (htmlspecialchars et autres.)
*/
require("../ressources/service/_islogged.php");
// J'inclu mon fichier sur le csrf.
require("../ressources/service/_csrf.php");
$error = $password = "";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hash"])){
    if(empty($_POST["hash"])){
        $error = "Veuillez entrer un mot de passe";
    }else{
        /*
            Le mot de passe n'ayant pas à être affiché et encore moins en clair, on n'a pas besoin d'assainir le 
            string. Mais on utilisera quand même trim pour éviter les espaces involontaires.
        */
        $password = trim($_POST["password"]);
        /* 
            password_hash permet de hacher le mot de passe donné en premier argument.

            En second argument, on va donner une constante prédéfini dans PHP au choix entre :
                PASSWORD_DEFAULT
                PASSWORD_BCRYPT
                PASSWORD_ARGON2I
                PASSWORD_ARGON2ID
            Ce sont des constantes représentante des algorythmes de hachage.
            PASSWORD_DEFAULT est une valeur qui peut évoluer dans le temps. Actuellement (8.1) il est égale à PASSWORD_BCRYPT mais si un meilleur algorythme de tri est ajouté à PHP, alors DEFAULT pourra évoluer et changer d'algo.

            En troisième argument on peut ajouter des options aux 
            algorythmes de tri. Par exemple pour "bcrypt" on peut ajouter un coût (cost) qui peut augmenter la sécurité au coût d'une durée de hachage plus longue. (Par défaut ce coût vaut 10).
            password_hash($pass, PASSWORD_BCRYPT, ["cost"=>20]);
        */
        $password = password_hash($password, PASSWORD_DEFAULT);
    }
    /*
        Le deuxième point à gérer, c'est les attaques par 
        "BRUTE FORCE". Cela consiste à tenter toute les combinaisons email-mot de passe possible pour trouver 
        un compte avec lequel se connecter.

        On pourra ignorer les attaques manuel, où l'utisateur 
        prendra des jours voir des mois à en trouver un de bon.
        Mais le problème vient des bots qui pourront faire plusieurs dizaines de tentative par seconde.

        Pour se protéger de ce genre d'attaque, plusieurs solutions: 
            1. Bloquer l'utilisateur après X tentatives et cela jusqu'au reset de son mot de passe.
                Problème :
                    Quelqu'un d'honnête mais maladroit pourrait être agacé.
                    Quelqu'un de malveillant pourrait s'amuser à bloquer tous vos utilisateurs.
            2. Ajout d'un "CAPTCHA" (Completely Automated Public Turing test to tell Computers and Humans Apart)
                Le principe d'un "CAPTCHA" est de forcer l'utilisateur à faire une action qu'un bot ne pourrait pas ou difficilement réaliser.
            3. L'ajout d'une authentification à double facteurs.
                Cela consiste à avoir en plus du mot de passe habituel, un code temporaire qui est généré et envoyé soit via une application soit par email ou 
                sms.
        Ici nous allons implémenter un petit CAPTCHA fait main, 
        mais pour ceux qui veulent aller plus loins, voici le lien vers la documentatoon du CAPTCHA de google :
        * https://developers.google.com/recaptcha/docs/v3
    */
    if(!isset($_POST["captcha"], $_SESSION["captchaStr"]) || 
        $_POST["captcha"] != $_SESSION["captchaStr"]){
            $error = "CAPTCHA incorrecte";
        }
    /*
        Parlons des attaques CSRF ou XSRF (Cross-Site Request Forgery).
        Cette attaque a pour but de créer une requête get ou post
        sur un site externe, mais de renvoyer les informations de cette requête, vers votre site.
        Afin que votre site valide une requête que votre utilisateur n'avait pas voulu.

        Pour se protéger de ce genre de requête, un captcha peut suffire, mais si on demande à vos utilisateurs de remplir à captcha à chaque petit message qu'il veut envoyer, 
        cela va vite l'agacer.

        On utilisera donc, des jetons (token) CSRF.
        le principe est de générer un jeton sauvegardé en session et donner un input hidden à notre formulaire contenant ce jeton. puis vérifier si les deux correspondent.

        Pour cela on va passer par un fichier externe que l'on va créer dans nos services "_csrf.php". 
    */
    if(!isCsrfValid()){
        $error = "La méthode utilisée n'est pas permise ou vous avez été trop lent.";
    }
}
$title = " Security ";
$headerTitle = "Sécurité";
require("../ressources/template/_header.php");
?>
<h1>Bienvenue <?php echo $_SESSION["username"] ?></h1>
<form action="" method="POST">
    <input type="text" name="password" placeholder="mot de passe à hacher" required>
    <!-- Début captcha -->
    <div>
        <label for="captcha">Veuillez recopier le texte ci-dessous pour valider :</label>
        <br>
        <img src="../ressources/service/_captcha.php" alt="CAPTCHA">
        <br>
        <input type="text" id="captcha" name="captcha" pattern="[A-Z0-9]{6}">
    </div>
    <!-- Fin captcha -->
    <!-- Début csrf -->
    <?php setCsrf(15) ?>
    <!-- Fin csrf -->
    <input type="submit" value="Hacher" name="hash">
    <span class="error"><?php echo $error ?? "" ?></span>
</form>
<!-- On est ici sur un outil pour développeur, donc on se permet
d'afficher le mot de passe haché, mais évidement en cas réel,
Jamais on n'affiche de mot de passe, que ce soit en clair ou haché. -->
<?php if(empty($error) && !empty($password)):?>
    <div>
        Votre mot de passe haché est :
        <?php echo $password ?>
    </div>
<?php
endif;
require("../ressources/template/_footer.php");
?>