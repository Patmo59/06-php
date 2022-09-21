<?php
$logged = isset($_SESSION["idUser"]) && $_GET["id"]==$_SESSION["idUser"];
$title = " MVC - Blog";
$headerTitle = "Blog de ".$user["username"];
require(__DIR__."/../../../ressources/template/_header.php");
if($flash): ?>
    <div class="flash">
        <?php echo $flash ?>
    </div>
<?php endif; 
if($logged):
?>
<form action="/05-mvc/message/create" method="post">
    <label>Nouveau Message</label><br>
    <textarea name="message" placeholder="Nouveau Message"></textarea><br>
    <select name="categorie">
        <option value="">Selection de catégorie</option>
        <?php foreach($categories as $cat): ?>
            <option value="<?php echo $cat["idCat"] ?>">
                <?php echo $cat["nom"] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <input type="submit" value="Envoyer" name="addMessage">
</form>
<hr>
<hr>
<hr>
<a href="?id=<?php echo $_GET["id"] ?>">
    Toutes les catégories.
</a>
<?php 
endif;
if($messages):
    foreach($messages as $m):
?>
<div class="message">
    <div class="date1"> 
        Ajouté le <?php echo $m["createdAt"] ?>
    </div>
    <div class="date2">
        <?php echo ($m["editedAt"]?"édité le : ".$m["editedAt"]: "") ?>
        <p><?php echo $m["message"] ?></p>
    </div>

    <div class="btns">
        <?php if(!empty($m["categorie"])): ?>
            <a href="?id=<?php echo $m["idUser"] ?>&cat=<?php echo $m["idCat"] ?>">
                <?php echo $m["categorie"] ?>
            </a>
        <?php endif; 
			if($logged): ?>
            <a href="/05-mvc/message/update?id=<?php echo $m["idMessage"] ?>">éditer</a>
            <a href="/05-mvc/message/delete?id=<?php echo $m["idMessage"] ?>">supprimer</a>
        <?php endif; ?>
        <hr>
        <hr>
    </div>
</div>
<?php 
endforeach;
else: 
?>
    <p>Cet utilisateur n'a aucun message</p>
<?php 
endif;
require(__DIR__."/../../../ressources/template/_footer.php");
?>