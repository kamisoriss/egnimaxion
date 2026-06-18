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

$provider = new \Wohali\OAuth2\Client\Provider\Discord([
    'clientId'     => '1501678332968833185',
    'clientSecret' => 'NbIUOM7-UTsjOcXLKuMU77J1y8XEzB6T',
    'redirectUri'  => 'https://egnimaxion.kamisoris.fr/discord_callback.php',
]);

// On définit les "scopes" (l'équivalent de email et profile chez Google)
$options = [
    'scope' => ['identify', 'email']
];

// On génère l'URL d'autorisation
$auth_url = $provider->getAuthorizationUrl($options);

// Redirection sécurisée vers Discord
header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
exit();
?>