<?php

use Class\AbstractController;
use Class\Interface\CrudInterface;
use Model\userModel;

require __DIR__."/../../ressources/service/_isloggedV2.php";

class UserController extends AbstractController implements CrudInterface
{
    use Class\Trait\Debug;
    private userModel $db;
    private string $regexPass ="/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";

function __construct()
{
    $this ->db = new UserModel();
}


    function create()
    {
        isLogged(false,"/06-poo"); 
        $username = $email = $password ="";
        $error=[];
        if($_SERVER["REQUEST_METHOD"]== 'POST' && isset($_POST["userform"])){
            if(empty($_POST["username"]))
            {
                $error["username"]= "Veuillez saisir un nom d'utilisateur";
            }
            else
            {
                $username = cleanData($_POST["username"]);
                if (!preg_match("/^[a-zA-Z' -]{2,25}$/", $username))
                {
                    $error["username"]= "Veuillez saisir un nom d'utilisateur valide";
                }
            }
            if(empty($_POST["email"]))
            {
                $error["email"]= "Veuillez saisir un email";
            }
            else
            {
                $email = cleanData($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $error["email"]= "Veuillez saisir un email valide";
                }
                $resultat = $this ->db -> getOneUserByEmail($email);
                if($resultat)
                {
                    $error["email"] = "cet email est déjà enregistré";
                }
            }
            if(empty($_POST["password"]))
            {
                $error["password"] = "Veuillez saisir un mot de passe ";
            }
            else{
                $password = cleanData($_POST["password"]);
                if(!preg_match($this ->regexPass, $password))
                {
                    $error["password"]= "Veuillez saisir un mot de passe valide";
                }
                else
                {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                }
            }
            if(empty($_POST["passwordBis"]))
            {
                $error["passwordBis"] = "Veuillez saisir à nouveau votre mot de passe";
            }
            else{
                if($_POST["passwordBis"] != $_POST["password"])
                {
                    $error["passwordBis"] = "Veuillez saisir le meme mot de passe ";
                }
            }
            if(empty($erroe))
            {
                $this ->db ->addUser($username, $email, $password);
                $this ->setFlash ("Inscription bien prise en compte");
                // TODO faire une methode de redirection dans l'abstractcontroller.
                header("Location: /06-poo");
                exit;
            }
        }
        $this ->render("user/inscription.php", [
            "error" => $error,
            "title" => "POO-Create",
            "header" => "Inscription",
            "required" => "required"
        ]);
    }
    function read()
    {
        // on récupère tous les utilisaturs
        $users = $this ->db ->getAllUsers();
        // $this -> dd($users);
        // on inclut la vue :
        $this ->render("user/list.php", [
            "users" => $users,
            "title" => "POO- Read",
            "header" => "Liste des utilisateurs"
        ]);
    }
    function update()
    {
        isLogged(true, "/06-poo");

        if(empty($_GET["id"]) || $_SESSION["idUser"] != $_GET["id"])
        {
            header("Location; /06-poo");
            exit;
        }
        $user = $this ->db -> getOneUserById((int)$_GET["id"]);
        $username = $paxxword = $email = "";
        $error = [];

        if($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["username"]))
        {
            if(!empty($_POST["username"]))
            {
                $username = cleanData($_POST["username"]);
                if(!preg_match("/^[a-zA-Z' -]{2,25}$/", $username))
                {
                    $error["username"] = "Votre nom d'uitilisateur ne peut contenir que des lettres"; 

            }
            if(!empty($_POST["email"]))
            {
                $email = cleanData($_POST["email"]);
                if(filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $error["email"] = "Veuillez choisir un email valide";
                }
                else{
                    $email = $user["email"];
                }
                
            }
            $resultat = $this ->db ->getOneUserByEmail($email);
            if($resultat && $resultat["email"] != $user["email"])
            {
                $error["email"] = "Cet email existe déjà : ";
            }
        }
        else{
            $email = $user["email"];
        }
        //password
        if(!empty($_POST["password"]))
        {
            if(empty($_POST["passwordBis"]))
            {
                $error["passwordBis"] = " Veuillez saisir à nouveau votre mot de passe";
            }
            elseif($_POST["password"] != $_POST["passwordBis"])
            {
                $error["passwordBis"] = " Veuillez saisir le meme mot de passe";
            }
            $password = cleanData($_POST["password"]);
            if(!preg_match($this ->regexPass, $password))
            {
                $error["password"] = " Veuillez saisire un mot de passe valide";
            }
            else
            {
                $password = password_hash($password , PASSWORD_DEFAULT);
            }
            
        }
        else
        {
            $password = $user["password"];
        }
        if(empty($error))
        {
            $this ->db ->updateUserById($username, $email,$password, $user["idUser"]);
            $this ->setFlash("Votre profil  a bien été edité");
            header("Location :  /06-poo");
            exit;
        }
    }

$this->render("user/update.php",[
    "error" => $error,
    "user" => $user,
    "title" => "POO- Update",
    "header" => "Mise a jour du Profil",
    "required" => false
]);
}
    function delete()
    {
        isLogged(true, "/06-poo");
        if(empty($_GET["id"]) || $_SESSION["idUser"] != $_GET["id"])
        {
            header("Location : /06-poo");
            exit;
        }
        $this ->db -> deleteUserById((int)$_GET["id"]);

        unset($_SESSION);
        session_destroy();
        setcookie("PHPSESSID","", time()-3600);

        header("refresh:5; url = /06-poo");
        $this ->render("user/delete.php", [
            "title"=>"POO -Delete",
            "header"=>"Compte supprimé"
        ]);
    }
}
?>