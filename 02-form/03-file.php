<?php 
/*
    ici nous allons voir comment uploader un fichier sur notre serveur.
    Même si nous ne le ferons pas ici, il est important de retenir que lorsque l'on téléverse un fichier, nous ne le mettons pas en BDD.
    On va simplement ranger notre fichier dans un dossier. 
    Puis sauvegarder le nom du fichier et/ou le chemin en BDD.
*/
$error = $target_file = $target_name = $mime_type = $oldName = "";
/*
    target_dir va contenir le chemin vers le dossier d'upload.
    Pour des raisons de sécurité, si vous comptez rendre les fichiers téléversé
    accessible à vos utilisateurs, il serait bon que votre dossier ne soit pas au milieu de dossiers sensible de votre projet.
    Les utilisateurs accedant à ces fichiers pourront voir le chemin vers le dossier d'upload.
*/
$target_dir = "./upload/";
// On crée un tableau des types mimes que l'on accepte pour notre téléversement.
$typesPermis = ["image/png", "image/jpeg", "application/pdf", "image/gif"];
// Arrive-t-on en POST par le formulaire que l'on a créé.
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload"])){
    /*
        Lorsque l'on upload un fichier, le serveur va le sauvegarder dans un dossier temporaire et suprimera le contenu de ce dossier une fois l'execution du script terminé. 
        On va donc vérifier que ce fichier correspond bien à nos attentes avant de le déplacer ailleurs.

        La première étape est de vérifier si upload du fichier s'est bien passé et qu'il existe belle et bien dans notre dossier temporaire.
        Pour cela on ne va pas utiliser $_GET ou $_POST mais $_FILES.
        Ici on nommé notre input "fichier" donc on va aller chercher $_FILES["fichier"].
        Cette entrée est elle même un tableau associatif comportant plusieurs informations.

        La première étant "tmp_name" qui est l'adresse temporaire du fichier.
        On va l'utiliser avec "is_uploaded_file()" pour vérifier qu'il a bien été téléversé.
    */
    if(!is_uploaded_file($_FILES['fichier']['tmp_name'])){
        $error = "Veuillez sélectionner un fichier";
    }else{
        /* 
            On trouvera le nom d'origine du fichier à la clef "name". 
            "basename()" va retourner le dernier composant d'un chemin.
                Par exemple si je lui donne "categorie/nourriture/pizza" il nous rendra "pizza".
            Ici on veut être sûr de n'obtenir que le nom du fichier. 
        */
        $oldName = basename($_FILES["fichier"]["name"]);
        /*
            La seconde étape est de préparer un nouveau nom pour notre fichier.
            Pourquoi cela ? Car qu'arrivera t-il si deux de vos utilisateurs téléverse deux fichiers de même nom comme "cv.pdf"?
            Et bien le second écrasera le premier.

            Donc pour éviter cela on va renommer nos fichiers grâce à la fonction "uniqid()"

            Elle peut être utilisé sans argument et produira 13 caractères aléatoire.
                !( Attention, à ne pas utiliser pour de la sécurité)
            "uniqid('', true)" Avec son second argument à true, on passera à 23 caractères aléatoire.
            "uniqid('chaussette')" Le premier argument permet de prefixer notre id.

            Dans l'exemple ci dessous on va se retrouver 
            avec un nom composé du timestamp actuel suivi d'un tiret, puis de 23 caractères aléatoire, puis un tiret et l'ancien nom du fichier.
            Autant dire que les chances de doublons sont infime.
        */
        $target_name = uniqid(time()."-", true) ."-". $oldName;
        /*
            On concatène le chemin vers le dossier d'upload au nouveau nom de notre fichier.

            On ne le fera pas ici mais on pourrait vouloir créer un dossier par utilisateur, ou un dossier par mois par exemple, dans ce cas là on pourrait utiliser :
            is_dir() pour vérifier si un dossier existe déjà. 
            mkdir() pour créer un nouveau dossier.
            On aurait alors plus qu'à ajouter ce dossier à notre concaténation.
        */
        $target_file = $target_dir . $target_name;
        /* 
            On récupère le type mime du fichier dans sa zone temporaire.

            Sur internat vous trouverez d'autre façon de faire comme vérifier l'extension du fichier, mais une extension de fichier se change très facilement, ce qui n'est pas très sécurisé.
        */
        $mime_type = mime_content_type($_FILES["fichier"]["tmp_name"]);
        /* 
            file_exists permet de vérifier si un fichier existe déjà. 
            Il prend en argument le chemin vers un fichier.
            Dans notre cas, il y a très peu de chance que cela arrive mais cela peut être utile dans d'autres cas.
        */
        if(file_exists($target_file)){
            $error = "Ce fichier existe déjà";
        }
        /* 
            Puis on vérifie la taille du fichier qui se trouve
            à la clef "size".
            Cela pour éviter que notre utilisateur nous remplisse notre serveur de fichiers de plusieurs giga.
            La taille est fournit en "octet" donc n'hesitez pas 
            à mettre un nombre assez élevé. 
        */
        if($_FILES["fichier"]["size"] > 500000){
            $error = "Ce fichier est trop volumineux !";
        }
        /* 
            On vérifie si le type mime du fichier fait partie ou non du tableau de type mime que l'on accepte.
        */
        if(!in_array($mime_type, $typesPermis)){
            $error = "Ce type de fichier n'est pas accepté.";
        }
        // Si notre variable $error est vide.
        if(empty($error)){
            /* 
                On utilise move_uploaded_file pour déplacer notre fichier depuis son dossier temporaire,
                Jusqu'à son emplacement final avec son nouveau nom.

                Cette fonction retourne un boolean indiquant si le déplacement s'est produit sans problème.
                On la place donc directement dans une condition pour indiquer si un problème a eu lieu.
                
                On aurait aussi pu faire :
                $uploaded = move_uploaded_file($from, $to);
                if($uploaded)
            */
            if(move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file)){
                /* 
                    Si tous s'est bien passé, on arrivera ici et il ne nous restera plus qu'à enregistrer le nom du fichier et/ou le chemin en BDD.
                */
            }else{
                $error = "Erreur lors de l'upload.";
            }
        }
    }
}

$title = " Upload ";
$headerTitle = "Téléversement";
require("../ressources/template/_header.php");
?>
<!-- On n'a pas d'autres choix que "POST" pour upload
un fichier. Et surtout on n'oublie pas l'enctype. -->
<form action="" method="post" enctype="multipart/form-data">
    <label for="fichier">Choisir un fichier :</label>
    <input type="file" name="fichier" id="fichier">
    <input type="submit" value="Envoyer" name="upload">
    <span class="error"><?php echo $error??"" ?></span>
</form>
<?php if(isset($_POST["upload"]) && empty($error)): ?>
    <p>
        Votre fichier a bien été téléversé sous le nom "<?php echo $target_name ?>". <br>
        Vous pouvez le télécharger <br>
        <a 
        href="<?php echo $target_file ?>" 
        download="<?php echo $oldName ?>"> ICI</a>
    </p>
<?php
endif; 
require("../ressources/template/_footer.php");
?>