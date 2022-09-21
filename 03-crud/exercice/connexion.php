<?php
require "../../ressources/service/_isloggedV2.php";
isLogged(false, "../02-read.php");
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
        require "../../ressources/service/_pdo.php";
        $pdo = connexionPDO();
        $sql = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $sql->execute([$email]);
        $user = $sql->fetch();
        if($user){
            if(password_verify($pass, $user["password"])){
                $_SESSION["logged"] = true;
                $_SESSION["username"] = $user["username"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["idUser"] = $user["idUser"];
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
require("../../ressources/template/_header.php");
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
    <span class="error"><?php echo $error["login"]??"" ?></span>
</form>
<?php
require("../../ressources/template/_footer.php");
?>