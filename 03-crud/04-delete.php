<?php 
require "../ressources/service/_isloggedV2.php";
isLogged(true, "./exercice/connexion.php");
/* 
    si il est connecté et qu'il tente de supprimer son propre
    compte uniquement. il pourra accèder à cette page.
*/
if(empty($_GET["id"]) || $_SESSION["idUser"] != $_GET["id"]){
    header("Location: ./02-read.php");
    exit;
}
// On supprime l'utilisateur.
require "../ressources/service/_pdo.php";
$pdo = connexionPDO();
$sql = $pdo->prepare("DELETE FROM users WHERE idUser=?");
$sql->execute([(int)$_GET["id"]]);
// On déconnecte l'utilisateur :
unset($_SESSION);
session_destroy();
setcookie("PHPSESSID", "", time()-3600);
// avant de le rediriger, on lui affiche un petit message.
header("refresh: 5; url = /");
$title = " CRUD - Delete ";
$headerTitle = "Suppression d'utilisateur";
require("../ressources/template/_header.php");
// rowCount permet de savoir combien de lignes ont été affecté par la dernière requête.
echo $sql->rowCount(), " ligne effacée.";
?>
<p>
    Vous avez bien <strong>supprimé</strong> votre compte. <br>
    Vous allez être redirigé d'ici peu.
</p>
<?php  
require("../ressources/template/footer.php");
?>