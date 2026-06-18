<?php
/*
 * Copyright (c) 2026 EGNIMAXION. Tous droits réservés.
 *
 * Ce fichier fait partie du projet Egnimaxion.
 * Toute reproduction, distribution, modification ou utilisation
 * non autorisée de ce code est strictement interdite.
 */

use GuzzleHttp\Exception\GuzzleException;
use Wohali\OAuth2\Client\Provider\Discord;
use Wohali\OAuth2\Client\Provider\DiscordResourceOwner;

session_start();
require_once 'vendor/autoload.php';
require_once 'php/bdd.php';

$bdd = conexionbdd();
$provider = new Discord([
    'clientId'     => '1501678332968833185',
    'clientSecret' => 'NbIUOM7-UTsjOcXLKuMU77J1y8XEzB6T',
    'redirectUri'  => 'https://egnimaxion.kamisoris.fr/discord_callback.php',
]);

if (isset($_GET['code'])) {
    try {
        /** @var DiscordResourceOwner $user */
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
        $user = $provider->getResourceOwner($token);
        $discord_id = $user->getId();
        $email = $user->getEmail();
        $nom_discord = $user->getUsername();
        $userdata = $user->toArray();
        $avatar_discord = $userdata['avatar'];
        if ($avatar_discord) {
            $ext = str_starts_with($avatar_discord, 'a_') ? 'gif' : 'png';
            $avatar_url = "https://cdn.discordapp.com/avatars/$discord_id/$avatar_discord.$ext";
        } else {
            $default_avatar_num = ($discord_id >> 22) % 6;
            $avatar_url = "https://cdn.discordapp.com/embed/avatars/$default_avatar_num.png";
        }

        // 4. On cherche si le joueur existe
        $req = $bdd->prepare("SELECT * FROM egnim_compte WHERE egnim_usermail = :email");
        $req->execute(["email"=>$email]);
        $utilisateur = $req->fetch();

        if ($utilisateur) {
            // --- CORRECTION ICI : On utilise 'username' pour correspondre à index.php ---
            $_SESSION['username'] = $utilisateur['egnim_username'];
            $_SESSION['id_joueur'] = $utilisateur['egnim_id_user'];
        } else {
            // Le joueur n'existe pas : on crée son compte
            $mot_de_passe = password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT);

            $insert = $bdd->prepare("INSERT INTO egnim_compte (egnim_username, egnim_usermail, egnim_password_user) VALUES (:username, :email, :password)");
            $insert->execute(['username'=>$nom_discord, "email"=>$email, "password"=>$mot_de_passe]);
            $_SESSION['username'] = $nom_discord;
            $_SESSION['id_joueur'] = $bdd->lastInsertId();
        }
        $_SESSION['avatar_url'] = $avatar_url;

        header('Location: index.php');
        exit();

    } catch (Exception $e) {
        echo "Erreur lors de la communication avec Discord : " . $e->getMessage();
        echo "<br><a href='index.php'>Retour à l'accueil</a>";
    } catch (GuzzleException $e) {
    }

} else {
    echo "Erreur lors de la connexion Discord (aucun code reçu).";
    echo "<br><a href='index.php'>Retour à l'accueil</a>";
}