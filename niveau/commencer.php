<?php
/*
 * Copyright (c) 2026 EGNIMAXION. Tous droits réservés.
 *
 * Ce fichier fait partie du projet Egnimaxion.
 * Toute reproduction, distribution, modification ou utilisation
 * non autorisée de ce code est strictement interdite.
 */

session_start();
$niveau = true;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'unlock') {

if (($_POST['csrf_token'] ?? '') === ($_SESSION['csrf_token'] ?? '')) {

$_SESSION['level1_completed'] = true;

if (isset($_SESSION['username'])) {
require_once('../php/bdd.php');
$bdd = conexionbdd();
$update = $bdd->prepare("UPDATE egnim_compte SET egnim_save = 2 WHERE egnim_username = ?");
$update->execute([$_SESSION['username']]);
}

header('Location: level2.php');
exit;
} else {
$error = "Erreur de sécurité (Token)";
}
}
$titre_page = "Niveau 1 - EGNIMAXION";
$titre_header = "level 1";
$chemin = "../";
$cacher_login = true;
include '../header.php';
?>
<main class="enigmatic-main mode-niveau">
    <h1>niveau 1</h1>

    <form method="post" style="display:inline;">
        <input type="hidden" name="action" value="unlock">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES) ?>">
        <button class="level1" type="submit" aria-label="Accéder au niveau 2"></button>
    </form>
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
<script src="../script/nav.js"></script>