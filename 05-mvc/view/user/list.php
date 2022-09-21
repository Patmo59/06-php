<?php 
$title = $headerTitle = " MVC -Liste Utilisateur ";
require(__DIR__."/../../../ressources/template/_header.php");
echo $flash??"";
if($users):
?>
<p> Seul l'utilisateur connecté accède à ses messages</p>
<table>
    <thead>
        <tr>
            <th>id</th>
            <th>username</th>
            <th>action</th>
        </tr>
    </thead>
    <?php foreach($users as $row):?>
    <tr>
        <td><?php echo $row["idUser"] ?></td>
        <td><?php echo $row["username"] ?></td>
        <td>
            <a title = "voir les messages"href="./message/list?id=<?php echo $row["idUser"] ?>">
                Voir 
            </a>
            <?php if(isset($_SESSION["idUser"]) && ($_SESSION["idUser"]) == $row["idUser"]): ?>
            &nbsp;|&nbsp;
            <a title=" Modifier mes données de connexion"href="./user/update?id=<?php echo $row["idUser"] ?>">
                Modifier
            </a>
            &nbsp;|&nbsp;
            <a  title= "Supprimer mon compte"href="./user/delete?id=<?php echo $row["idUser"] ?>">
                Supprimer 
            </a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<!-- Sinon on affiche un message -->
<?php else: ?>
    <p>Aucun utilisateur trouvé</p>
<?php 
endif;
require(__DIR__."/../../../ressources/template/_footer.php");
?>