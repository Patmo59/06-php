<?php
// on crée une session :
session_start();
/*
    On va vérifier si il existe une clef "logged" dans notre session
    et si elle existe, est ce qu'elle est égale à true.
    Si c'est le cas, on va considérer notre utilisateur comme connecté. 
    Et un utilisateur connecté, n'a rien à faire sur la page de connexion.
    On va donc le rediriger ailleurs.
*/
if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true){
    header("Location: /");
    die;
}
$email = $pass = "";
$error = [];

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"]))
{
    if(empty($_POST["email"])){
        $error["email"] = "Veuillez entrer un email";
    }else{
        $email = trim($_POST["email"]);
    }
    if(empty($_POST["password"])){
        $error["pass"] = "Veuillez entrer un mot de passe";
    }else{
        $pass = trim($_POST["password"]);
    }
    if(empty($error)){
        /*
            Normalement on devrait aller chercher notre utilisateur en BDD. 
            Mais pour l'instant on n'a pas encore vu comment gérer une BDD, donc on se contentera d'utiliser un fichier JSON.

            file_get_contents() est une fonction permettant de récupérer le contenu d'un fichier.
        */
        $users = file_get_contents("../ressources/users.json");
        /* 
            json_decode() permet de transformer une chaîne de caractère de type json en objet utilisable en php.
            Si on lui donne en second argument un boolean à true, 
            plutôt qu'un objet il nous rendra un tableau associatif.

            On ne l'utilisera pas là, mais pour transformer un élément PHP en json,
            c'est la fonction json_encode();
        */
        $users = json_decode($users, true);
        /* 
            On tente de récupérer un utilisateur.
            Si l'adresse email existe, on obtient l'utilisateur,
            sinon on obtient false.
        */
        $user = $users[$email]??false;
        if($user){
            /* 
                Si on regarde notre fichier json, les mots de passe sont haché. 
                Par ce fait on ne peut pas comparer le mot de passe entré par l'utilisateur et celui qu'on a en mémoire.
                Mais nous pouvons faire appel à :
                    password_verify() qui prendra 
                    en premier argument, un mot de passe en clair.
                    en second, un mot de passe haché. 
                et nous répondra true si ils correspondent et false dans le cas contraire.
            */
            if(password_verify($pass, $user["password"])){
                /* 
                    Si notre mot de passe est correcte,
                    On va créer en session une entrée à true indiquant que notre utilisateur est connecté. 
                    (ici "logged")
                    Et on pourra sauvegarder en session, les informations de l'utilisateur qu'on souhaite réutiliser ailleurs.
                    (Ici username et email)
                    Si on souhaite deconnecter automatiquement notre utilisateur au bout d'un certain temps.
                    On pourra aussi sauvegarder une date d'expiration.
                */
                $_SESSION["logged"] = true;
                $_SESSION["username"] = $user["username"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["expire"] = time()+ (60*60);
                // Une fois connecté, je redirige mon utilisateur.
                header("Location: /");
                exit;
            }else{
                /*
                    ! Parlons sécurité :
                    On remarquera, que j'ai mit le même message d'erreur, si le mot de passe ou si l'email est incorrecte.
                    Cela pour éviter qu'un utilisateur malveillant
                    voulant brute force notre site, ne sache pas si il entre un email valide.
                */
                $error["login"] = "Email ou mot de passe incorrecte.";
            }
        }else{
            $error["login"] = "Email ou mot de passe incorrecte.";
        }
    }
}
$title = " Login ";
$headerTitle = "Connexion";
require("../ressources/template/_header.php");
?>
<form action="" method="post">
    <label for="email">Votre Email :</label>
    <input type="email" name="email" id="email">
    <br>
    <span class="error"><?php echo $error["email"]??"" ?></span>
    <br>
    <label for="password"> Votre mot de passe :</label>
    <input type="password" name="password" id="password">
    <br>
    <span class="error"><?php echo $error["pass"]??"" ?></span>
    <br>
    <input type="submit" value="Connexion" name="login">
    <br>
    <!-- <span class="error"><?php echo $error["login"]??"" ?></span> -->
</form>
<?php
require("../ressources/template/_footer.php");
?>