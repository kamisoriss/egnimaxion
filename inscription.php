<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Inscription - EGNIMAXION</title>
<link href="https://fonts.googleapis.com/css2?family=Unica+One&family=Orbitron:wght@700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="normalize.css">
    <script src="script/audio.js"></script>
</head>
<body>
<div class="maze-bg"></div>
<header class="enigmatic-header">
    <span class="header-bg-puzzle">
        <audio id="musique-fond" src="assets/sound/egnimaxion_backsound.mp3" loop></audio>
    </span>
        <h1>inscription</h1>
    </header>
<?php
include ('nav.php');
?>
<main class="enigmatic-main">
	<h1>Créer un compte</h1>
	<form class="inscription" action="" method="post">
		<label>Pseudo<br><input id="username" name="username" type="text" required /></label>
		<label >Email<br><input id="email" name="email" type="email" required /></label>
		<label >Mot de passe<br><input id="password" name="password" type="password" required /></label>
        <label>Confirmation mot de passe<br><input type="password" name="confirm_password" required></label>
		<button type="submit">S'inscrire</button>
	</form>
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
</body>
</html>

<!-- script navigation -->
<script src="script/nav.js"></script>

<?php

?>
