<?php
/*
 * Copyright (c) 2026 EGNIMAXION. Tous droits réservés.
 *
 * Ce fichier fait partie du projet Egnimaxion.
 * Toute reproduction, distribution, modification ou utilisation
 * non autorisée de ce code est strictement interdite.
 */

session_start();

// ... laisse la suite de ton code en dessous (session_start(); etc.)
require_once 'vendor/autoload.php';

$client = new Google\Client();
$client->setClientId('793958890668-66e1ttk3r755d79atcjupigeh21kprss.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://egnimaxion.kamisoris.fr/google_callback.php');

$client->addScope("email");
$client->addScope("profile");

$auth_url = $client->createAuthUrl();
header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
exit();
?>