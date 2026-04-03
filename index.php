<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>  EGNIMAXION</title>
    <link rel="stylesheet" href="normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Unica+One&family=Orbitron:wght@700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="script/audio.js"></script>
    <script src="script/box.js"></script>
</head>
<body>
<div class="maze-bg"></div>
<header class="enigmatic-header">
    <span class="header-bg-puzzle">
        <audio id="musique-fond" src="assets/sound/egnimaxion_backsound.mp3" loop></audio>
  </span>
    <h1>EGNIMAXION</h1>
</header>
<div id="login-box">
    <button id="login-open-box-buton"><img src="assets/img/log-login.png" alt="logo-login"></button>
    <div id="login-open-box">
        <p>Connexion</p>
        <form method="post">
            <label>identifiant:<input type="text" name="username"></label>
            <label>mot de passe:<input type="password" name="password"></label>
            <div class="btn-row">
            <input type="submit" name="validé" value="connexion"><a href="inscription.php" id="inscription">s'inscrir</a>
            </div>
        </form>
    </div>
</div>
<?php
include ('nav.php');
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

    <ul><li><a class="legal-link" href="mention_legal.php">Mention légale</a></li></ul>
</footer>

<script src="script/nav.js"></script>
</body>
</html>