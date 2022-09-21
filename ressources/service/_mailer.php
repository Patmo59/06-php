<?php 
/*
    L'envoi de mail depuis le local peut être une plaie 
    à configurer, de plus cela demanderais de modifier 
    certains paramètres de PHP, pour faire les choses 
    plus simplement nous utiliserons deux outils :

        PHPMailer qui est une librairie simplifiant grandement 
        l'envoi de mail.

        Et https://mailtrap.io qui va me permettre d'intercepter
        ces faux mails envoyé depuis le localhost.
    On reviendra dessus en POO, mais on va appeler 
    les namespaces de PHPMailer,
    On peut imagine les namespace comme des dossiers virtuels 
    dans lesquels sont rangé nos classes.
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
/*
    Ensuite si on a fait l'installation via composer.
    On va pouvoir utiliser l'autoloader de composer.
    Celui ci va permettre d'utiliser les classes de nos 
    bibliothèques sans avoir besoin de les require.
*/
require __DIR__ . "/../vendor/autoload.php";
/**
 * Envoi un mail.
 *
 * @param string $from
 * @param string $to
 * @param string $subject
 * @param string $body
 * @return string
 */
function sendMail(string $from, string $to, string $subject, string $body): string
{
    /*
        J'instancie un nouvel objet phpMailer.
        Le paramètre à true permet d'activer les erreurs sous
        forme d'exception.
    */
    $mail = new PHPMailer(true);
    try {
        /* 
            * Paramètre du serveur :
            On active l'utilisation de SMTP:
            (Simple Mail Transfer Protocol)
        */
        $mail->isSMTP();
        /*
            On indique où est hébergé le serveur de mail.
        */
        $mail->Host = "smtp.mailtrap.io";
        /* 
            On active l'authentification par SMTP
        */
        $mail->SMTPAuth = true;
        /*
            On indique par quel port du serveur de mail passer.
        */
        $mail->Port = 2525;
        /* 
            On place l'username et le password du serveur de mail.
        */
        $mail->Username = 'votreUsername';
        $mail->Password = 'votrePassword';
        /* 
            Affiche de nombreux détails sur le déroulement de la requête.
        */
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        /*
            Le type de chiffrement utilisé pour envoyer le mail.
            Ici je ne l'utiliserai pas, car peut rentrer en conflit avec mailtrap.
        */
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        /* 
            * Expediteur et Destinataire.

            "setFrom" prendra l'adresse de l'expediteur
            (et optionnellement un nom.)
        */
        $mail->setFrom($from);
        /* 
            "addAddress" ajoute un destinataire. 
            (optionnellement on peut ajouter un nom)
        */
        $mail->addAddress($to);
        /*
            "addReplyTo" permet d'indiquer à qui on répond.
            "addCC" permet d'ajouter une adresse en copie.
            "addBCC" permet d'ajouter une adresse en copie caché.

            * Pièce jointe
            addAttachment($path, $name)
            Ajoute le fichier donné en premier argument comme pièce jointe.
            Et le renomme si le second argument est donné.

            *contenu
            "isHTML" indique que le format du mail est html.
        */
        $mail->isHTML(true);
        /*
            "Subject" permet d'indiquer le sujet du mail.
            "Body" permet d'indiquer le corps du mail.
        */
        $mail->Subject = $subject;
        $mail->Body = $body;
        /*
            "AltBody" pour ajouter un corps différent pour les applications qui ne gèrent pas le HTML.

            Enfin il nous reste qu'à envoyer le tout !
        */
        $mail->send();
        return "Message Envoyé";
    } catch (Exception $e) {
        return "Le message n'a pas pu être envoyé. Mailer Error : {$mail->ErrorInfo}";
    }
}
?>