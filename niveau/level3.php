<?php
/*
 * Copyright (c) 2026 EGNIMAXION. Tous droits réservés.
 *
 * Ce fichier fait partie du projet Egnimaxion.
 * Toute reproduction, distribution, modification ou utilisation
 * non autorisée de ce code est strictement interdite.
 */

$isSecure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => $isSecure,
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();
if (!isset($_SESSION['username'])) {
    $timeout = 7200; // 2 heures
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
        // Trop tard pour l'anonyme : on efface tout et il doit refaire le niveau 1
        session_unset();
        session_destroy();
        header('Location: commencer.php');
        exit;
    }
}
$_SESSION['last_activity'] = time();
$acces_autorise = false;
if (isset($_SESSION['username'])) {
    require_once('../php/bdd.php');
    $bdd = conexionbdd();
    $request = $bdd->prepare("SELECT egnim_save FROM egnim_compte WHERE egnim_username = ?");
    $request->execute([$_SESSION['username']]);
    $joueur = $request->fetch();
    if ($joueur && $joueur['egnim_save'] >= 3) {
        $acces_autorise = true;
    }
}
else {
    if (isset($_SESSION['level2_completed']) && $_SESSION['level2_completed'] === true) {
        $acces_autorise = true;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'unlock') {

if (($_POST['csrf_token'] ?? '') === ($_SESSION['csrf_token'] ?? '')) {

    $_SESSION['level3_completed'] = true;

    if (isset($_SESSION['username'])) {
        require_once('../php/bdd.php');
        $bdd = conexionbdd();
        $update = $bdd->prepare("UPDATE egnim_compte SET egnim_save = 4 WHERE egnim_username = ?");
        $update->execute([$_SESSION['username']]);
    }

    header('Location: level4.php');
}else {
    $error = "Erreur de sécurité (Token)";
}}
if (!$acces_autorise) {
    header('Location: commencer.php');
    exit;
}
$titre_page = "Niveau 3 - EGNIMAXION";
$titre_header = "level 3";
$chemin = "../";
$cacher_login = true;
include '../header.php';
?>
<main class="enigmatic-main">
    <h1>Niveau 3</h1>
    <p>Bienvenue au niveau 3 </p>

</main>
<div id="controles-volume">
    <button id="bouton-mute">
        <img src="../assets/img/soundplay.png" alt="Volume" id="icone-volume-on" class="icone show" draggable="false">
        <img src="../assets/img/soundstop.png" alt="Mute" id="icone-volume-off" class="icone" draggable="false">
    </button>

    <div class="curseur-piste" id="volume-piste">
        <img src="../assets/img/soundbar.png" alt="Piste" class="piste-vide" draggable="false">

        <div class="remplissage-barre" id="remplissage-barre">
            <img src="../assets/img/soundbarfill.png" alt="Remplissage" class="barre-pleine" draggable="false">
        </div>

        <img src="../assets/img/soundbarcursor.png" alt="Curseur" class="curseur-rond" id="curseur-rond" draggable="false">
    </div>

    <span id="volume-texte">15%</span>
</div>

<footer>

    <ul><li><a class="legal-link" href="../mention_legal.php">Mention légale</a></li></ul>
    <ul><li>><a class="legal-link" href="../cgu.php"></a></li></ul>
</footer>
</body>
<script src="../script/nav.js"></script>
</html>