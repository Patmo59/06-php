<?php 
session_start();
require("../ressources/service/_mailer.php");
$email = $subject = $body = $envoi = "";
$error = [];
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["contact"]))
{
    if(empty($_POST["email"]))
        $error["email"] = "Veuillez entrer un email.";
    else{
        $email = cleanData($_POST["email"]);
        /* 
            prend un string en premier argument, 
            puis une constante en second argument.
            et selon la constante, valide ou assaini le string.

            Ici on valide le fait que notre string ressemble à un email
        */
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            $error["email"] = "Veuillez entrer un email valide.";
    }
    if(empty($_POST["sujet"]))
        $error["sujet"] = "Veuillez entrer un sujet.";
    else
        $subject = cleanData($_POST["sujet"]);
    if(empty($_POST["corps"]))
        $error["corps"] = "Veuillez laisser un message.";
    else
        $body = cleanData($_POST["corps"]);
    if(!isset($_POST["captcha"], $_SESSION["captchaStr"]) || 
    $_POST["captcha"] != $_SESSION["captchaStr"])
    {
        $error["captcha"] = "CAPTCHA incorrecte";
    }
    // TODO: changer l'username et le password dans mailer.
    if(empty($error))
        $envoi = sendMail(
            $email,
            "cours@nolwenn.fr",
            $subject,
            $body
        );
}
function cleanData(string $data):string{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}
$title = " Email ";
$headerTitle = "Courriel";
require("../ressources/template/_header.php");
if(!empty($envoi)):
?>
<p>
    <?php echo $envoi ?>
</p>
<?php endif; ?>
<form action="" method="post">
    <input type="email" name="email" placeholder="Votre Email">
    <span class="error"><?php echo $error["email"]??"" ?></span>
    <br>
    <input type="text" name="sujet" placeholder="Sujet du message">
    <span class="error"><?php echo $error["sujet"]??"" ?></span>
    <br>
    <textarea name="corps" placeholder="Votre message" cols="30" rows="10"></textarea>
    <span class="error"><?php echo $error["corps"]??"" ?></span>
    <!-- CAPTCHA -->
    <div>
        <label for="captcha">Veuillez recopier le texte ci-dessous pour valider :</label>
        <br>
        <img src="../ressources/service/_captcha.php" alt="CAPTCHA">
        <br>
        <input type="text" id="captcha" name="captcha" pattern="[A-Z0-9]{6}">
        <span class="error"><?php echo $error["captcha"]??"" ?></span>
    </div>
    <input type="submit" value="Envoyer" name="contact">
</form>
<?php
require("../ressources/template/_footer.php");
?>