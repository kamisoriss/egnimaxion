<?php
/*
 * Copyright (c) 2026 EGNIMAXION. Tous droits réservés.
 *
 * Ce fichier fait partie du projet Egnimaxion.
 * Toute reproduction, distribution, modification ou utilisation
 * non autorisée de ce code est strictement interdite.
 */

session_start();
require_once 'vendor/autoload.php';
require_once 'php/bdd.php';

$bdd = conexionbdd();

$client = new Google\Client();
$client->setClientId('793958890668-66e1ttk3r755d79atcjupigeh21kprss.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://egnimaxion.kamisoris.fr/google_callback.php');
if (isset($_GET['code'])) {

    // 1. On échange le code contre le jeton d'accès
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // 2. On récupère les infos du joueur
    $google_oauth = new Google\Service\Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    $email = $google_account_info->email;
    $nom_google = $google_account_info->name;
    $avatar_google = $google_account_info->picture;
    // 3. On cherche si le joueur existe
    $req = $bdd->prepare("SELECT * FROM egnim_compte WHERE egnim_usermail = :email");
    $req->execute(["email"=>$email]);
    $utilisateur = $req->fetch();

    if ($utilisateur) {
        // Le joueur existe déjà (on utilise bien 'egnim_username')
        $_SESSION['username'] = $utilisateur['egnim_username'];
        $_SESSION['id_joueur'] = $utilisateur['egnim_id_user'];
        $_SESSION['avatar_url'] = $avatar_google;
    } else {
        // Le joueur n'existe pas : on crée son compte
        $mot_de_passe = password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT);

        $insert = $bdd->prepare("INSERT INTO egnim_compte (egnim_username, egnim_usermail, egnim_password_user) VALUES (:username, :email, :password)");
        $insert->execute(['username'=>$nom_google, "email"=>$email, "password"=>$mot_de_passe]);

        $_SESSION['username'] = $nom_google;
        $_SESSION['id_joueur'] = $bdd->lastInsertId();
        $_SESSION['avatar_url'] = $avatar_google;
    }

    header('Location: index.php');
    exit();

} else {
    echo "Erreur lors de la connexion Google.";
    echo "<br><a href='index.php'>Retour à l'accueil</a>";
}
?>