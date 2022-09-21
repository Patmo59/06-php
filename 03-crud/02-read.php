<?php 
session_start();
require "../ressources/service/_pdo.php";
$pdo = connexionPDO();
/* 
    Dans la requête  que je vais faire ici, il n'y a aucune entrée
    de l'utilisateur, donc je n'ai pas besoin de préparer ma requête.
    Je peux la lancer directement avec "query".
*/
$sql = $pdo->query("SELECT idUser, username FROM users");
/* 
    Quand on souhaite récupérer plusieurs résultats et non un seul.
    On va remplacement "fetch" par "fetchAll";
*/
$users = $sql->fetchAll();
$title = " CRUD - Read ";
$headerTitle = "Liste utilisateur";
require("../ressources/template/_header.php");
/*
    Un flash message, est un message qui doit s'afficher après une action, puis disparaître une fois la page actualisé ou changé.
*/
if(isset($_SESSION["flash"])){
    echo $_SESSION["flash"];
    unset($_SESSION["flash"]);
}
if($users):
?>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>action</th>
            </tr>
        </thead>
        <!-- Pour chacun des utilisateurs, on ajoute une ligne -->
        <?php foreach($users as $row):?>
            <tr>
                <td><?php echo $row["idUser"] ?></td>
                <td><?php echo $row["username"] ?></td>
                <td>
                    <a href="./exercice/blog/read.php?id=<?php echo $row["idUser"] ?>">Voir</a>
                    <!-- Si la ligne correspond à l'utilisateur connecté, alors on affiche ces liens -->
                    <?php if(isset($_SESSION["idUser"]) && $_SESSION["idUser"] === $row["idUser"]): ?>
                        &nbsp;|&nbsp;
                        <a href="./03-update.php?id=<?php echo $row["idUser"] ?>">Editer</a>
                        &nbsp;|&nbsp;
                        <a href="./04-delete.php?id=<?php echo $row["idUser"] ?>">Supprimer</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Aucun utilisateur trouvé.</p>
<?php
endif; 
require "../ressources/template/_footer.php";
?>