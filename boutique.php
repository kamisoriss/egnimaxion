<?php
/*
 * Copyright (c) 2026 EGNIMAXION. Tous droits réservés.
 *
 * Ce fichier fait partie du projet Egnimaxion.
 * Toute reproduction, distribution, modification ou utilisation
 * non autorisée de ce code est strictement interdite.
 */

session_start();
require_once ('php/bdd.php');
$bdd = conexionbdd(); // On charge la base de données en premier

// --- Configuration pour le header ---
$titre_page = "Boutique - EGNIMAXION";
$titre_header = "boutique";
$chemin = ""; // On est à la racine, donc pas de "../"

// On appelle le super-fichier qui charge TOUT (head, fond, login-box, musique et menu nav)
include 'header.php';
?>

<main class="enigmatic-main">

    <h2>Nos articles</h2>
    <p>Bienvenue dans la boutique d'Egnimaxion. Le contenu arrivera très bientôt !</p>

</main>


<div id="controles-volume">
    <button id="bouton-mute">
        <img src="assets/img/soundplay.png" alt="Volume" id="icone-volume-on" class="icone show" draggable="false">
        <img src="assets/img/soundstop.png" alt="Mute" id="icone-volume-off" class="icone" draggable="false">
    </button>

    <div class="curseur-piste" id="volume-piste">
        <img src="assets/img/soundbar.png" alt="Piste" class="piste-vide" draggable="false">

        <div class="remplissage-barre" id="remplissage-barre">
            <img src="assets/img/soundbarfill.png" alt="Remplissage" class="barre-pleine" draggable="false">
        </div>

        <img src="assets/img/soundbarcursor.png" alt="Curseur" class="curseur-rond" id="curseur-rond" draggable="false">
    </div>

    <span id="volume-texte">15%</span>
</div>

<footer>
    <?php include 'footer.php'; ?>
</footer>
<script src="script/nav.js"></script>