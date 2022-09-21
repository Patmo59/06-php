<form action="" method="post">
    <!-- username -->
    <label for="username">Nom d'Utilisateur :</label>
    <input 
        type="text" 
        name="username" 
        id="username" 
        <?php echo $required ?>
        value ="<?php $user["username"]??""?>"
        >
    <span class="erreur"><?php echo $error["username"]??""; ?></span>
    <br>
    <!-- Email -->
    <label for="email">Adresse Email :</label>
    <input 
        type="email" 
        name="email" 
        id="email" 
        <?php echo $required ?>
        value ="<?php $user["email"]??"" ?>"
        >
    <span class="erreur" ><?php echo $error["email"]??""; ?></span> 
    <br>
    <!-- Password -->
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" <?php echo $required ?>>
    <span class="erreur"><?php echo $error["password"]??""; ?></span> 
    <br>
    <!-- password verify -->
    <label for="passwordBis">Confirmation du mot de passe :</label>
    <input type="password" name="passwordBis" id="passwordBis" <?php echo $required ?>>
    <span class="erreur"><?php echo $error["passwordBis"]??""; ?></span> 
    <br>

    <input type="submit" value="Valider" name="userForm">
</form>