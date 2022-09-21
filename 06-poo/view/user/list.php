<?php 
//on recupère les messages flash
$this -> getFlash();

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
    <?php foreach($users as $rw): ?>
        <!-- tr>td*2+td>a*3 -->
        <tr>
            <td><?php echo $rw["idUser"]?></td>
            <td><?php echo $rw["username"]?></td>
            <td>
                <a href="./messages?id=">Voir</a>
                <?php if(isset($_SESSION["idUser"]) && ($_SESSION["idUser"]== $rw["idUser"])): ?>
                <a href="./user/update?id="><?php echo $rw["idUser"]?>Editer</a>
                <a href="./user/delete?id="><?php echo $rw["idUser"]?>Supprimer</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        
</table>
<?php else: ?>
    <p>Aucun utilisateur trouvé</p>
<?php endif; ?>