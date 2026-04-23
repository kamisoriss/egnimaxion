<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Mode "bavard" activé
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host       = 'smtp.ionos.fr';
    $mail->SMTPAuth   = true;
    // METTEZ VOS VRAIS IDENTIFIANTS ICI POUR LE TEST
    $mail->Username   = 'contact@egnimaxion.kamisoris.fr';
    $mail->Password   = '2019200Rb@Betryu';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('contact@egnimaxion.kamisoris.fr', 'Test IONOS');
    // METTEZ VOTRE ADRESSE GMAIL ICI POUR RECEVOIR LE TEST
    $mail->addAddress('romainbouchard1401@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Test SMTP IONOS';
    $mail->Body    = 'Ceci est un test.';

    $mail->send();
    echo "<h2 style='color:green;'>L'e-mail est parti !</h2>";
} catch (Exception $e) {
    echo "<h2 style='color:red;'>Erreur fatale : " . $mail->ErrorInfo . "</h2>";
}
?>