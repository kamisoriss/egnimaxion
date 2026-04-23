<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('php/bdd.php');
$bdd = conexionbdd();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {

    $email_destinataire = htmlspecialchars($_POST['email']);

    $mailrecupreq = $bdd->prepare("SELECT egnim_usermail FROM egnim_compte WHERE egnim_usermail = ?");
    $mailrecupreq->execute([$email_destinataire]);
    $mailrecup = $mailrecupreq->fetch();

    if ($mailrecup) {

        try {
            $token = bin2hex(random_bytes(32));
        } catch (\Exception $e) {
            echo "<p style='color:red;'>Erreur interne du serveur. Impossible de générer un lien sécurisé.</p>";
            exit;
        }

        $expires = date("Y-m-d H:i:s", time() + 3600);

        $updateToken = $bdd->prepare("UPDATE egnim_compte SET egnim_reset_token = ?, egnim_reset_expires = ? WHERE egnim_usermail = ?");
        $updateToken->execute([$token, $expires, $email_destinataire]);
        $mail = new PHPMailer(true);

        try {
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host       = $_SERVER['SMTP_HOST'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $_SERVER['SMTP_USER'];
            $mail->Password   = $_SERVER['SMTP_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = $_SERVER['SMTP_PORT'];

            $mail->setFrom($_SERVER['SMTP_USER'], 'EGNIMAXION');
            $mail->addAddress($email_destinataire);

            $mail->isHTML(true);
            $mail->Subject = 'Réinitialisation de votre mot de passe';

            $url = "https://egnimaxion.kamisoris.fr/nouveau_mdp.php?token=" . $token;
            $mail->Body = 'Bonjour,<br><br>Vous avez demandé à réinitialiser votre mot de passe.<br>
                           Voici votre lien sécurisé (valable 1 heure) : <br>
                           <a href="' . $url . '">Cliquez ici pour changer de mot de passe</a>.<br><br>
                           Si vous n\'êtes pas à l\'origine de cette demande, ignorez cet email.<br><br>
                           L\'équipe EGNIMAXION.';
            $mail->send();

            echo "<p style='color:#00ffff;'>Un email contenant les instructions a été envoyé.</p>";

        } catch (Exception $e) {
            echo "<p style='color:red;'>Erreur lors de l'envoi : {$mail->ErrorInfo}</p>";
        }
    } else {
        echo "<p style='color:red;'>Cette adresse email n'est associée à aucun compte.</p>";
    }

} else {
    echo "<p style='color:red;'>Accès refusé.</p>";
}
?>