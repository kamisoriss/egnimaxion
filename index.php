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
/**
 *
 */
$bdd = conexionbdd();
$message_erreur = "";
if (isset($_POST['disconnect'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
if (isset($_POST['validé'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $request = $bdd->prepare("select * from egnim_compte where egnim_username = ?");
        $request->execute(array($_POST['username']));
        $requestresult = $request->fetch();

        if ($requestresult && password_verify($_POST['password'], $requestresult['egnim_password_user'])) {
            $_SESSION['username'] = $requestresult['egnim_username'];
            header("Location: index.php");
            exit;
        } else {
            $message_erreur = "<p style='color:red;'>Identifiant ou mot de passe incorrect</p>";
        }
    } else {
        $message_erreur = "<p style='color:red;'>Veuillez remplir toutes les cases</p>";
    }
}
include 'header.php';
?>
<main class="enigmatic-main">
  <h1>Bienvenue sur EGNIMAXION</h1>
  <p>Plongez dans un univers d'énigmes captivantes et de défis intellectuels. Que vous soyez un amateur de puzzles ou un passionné de casse-têtes, EGNIMAXION est votre destination ultime pour tester vos compétences et stimuler votre esprit.</p>
  <p>Explorez notre collection variée d'énigmes, participez à des compétitions palpitantes, et connectez-vous avec une communauté de passionnés partageant les mêmes intérêts. Préparez-vous à relever des défis, à découvrir des solutions ingénieuses, et à vivre une expérience enrichissante.</p>
  <p>Rejoignez-nous dès aujourd'hui et commencez votre aventure au cœur du mystère avec EGNIMAXION!</p>
  <p>Ne pas oubliez de vous inscrire ou de vous connecter pour accéder à toutes les fonctionnalités du site.</p>
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