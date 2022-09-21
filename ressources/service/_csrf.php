<?php  
if(session_status() === PHP_SESSION_NONE)
    session_start();
/**
 * Paramètre un token en session et ajoute un input:hidden contenant ce token
 * 
 * Optionnellement ajoute un temps avant expiration du token
 *
 * @param integer $time
 * @return void
 */
function setCsrf(int $time = 0): void{
    /* 
        Si $time est plus grand que 0, j'ajoute en session un  temps après lequel le jeton va expirer.
    */
    if($time>0)
        $_SESSION["tokenExpire"] = time() + 60*$time;
    /*
        random_bytes va retourner un nombre d'octet aléatoire d'une longueur donnée en paramètre.
        bin2hex va convertir ces octets en hexadecimal.
    */
    $_SESSION["token"] = bin2hex(random_bytes(60));
    /* 
        J'affiche un input hidden que l'on pourra placer 
        dans nos formulaire, contenant notre jeton.
    */
    echo '<input type="hidden" name="token" value="'
        .$_SESSION["token"].'">';
}
/**
 * Vérifie si le jeton est valide.
 *
 * @return boolean
 */
function isCsrfValid(): bool{
    /*
        Si tokenExpire n'existe pas ou qu'il est plus grand que 
        le timestamp actuel.
    */
    if(!isset($_SESSION["tokenExpire"]) 
        || $_SESSION["tokenExpire"] > time())
    {
        /*
            Si "token" existe en session et en POST
            et que les deux sont les même.
            Alors on retourne true.
        */
        if(isset($_SESSION["token"], $_POST["token"]) 
        && $_SESSION["token"] == $_POST["token"])
            return true;
    }
    /* 
        Sinon on change le code de status de la page 
        puis on retourne false.
    */
    header($_SERVER['SERVER_PROTOCOL'].' 405 Method Not Allowed');
    return false;
}
?>