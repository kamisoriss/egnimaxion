<!--
  Fichier : index.php
  Rôle : page d'accueil du site EGNIMAXION.
  Contenu : en-tête décoratif, navigation, fond graphique (maze-bg) et texte d'introduction.
  Commentaires ajoutés en français pour faciliter la maintenance.
-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>  EGNIMAXION</title>
    <link rel="stylesheet" href="normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Unica+One&family=Orbitron:wght@700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="enigmatic-header">
    <span class="header-bg-puzzle">
  </span>
    <h1>EGNIMAXION</h1>
</header>
<?php
include ('nav.php');
?>
<!-- Fond labyrinthe subtil -->
<svg class="maze-bg" viewBox="0 0 400 400">
  <circle cx="200" cy="200" r="180" fill="none" stroke="#23262a" stroke-width="16" />
  <circle cx="200" cy="200" r="140" fill="none" stroke="#23262a" stroke-width="8" />
  <path d="M60,200 Q200,60 340,200 Q200,340 60,200 Z" fill="none" stroke="#23262a" stroke-width="6" />
  <path d="M200,60 Q340,200 200,340 Q60,200 200,60 Z" fill="none" stroke="#23262a" stroke-width="6" />
</svg>

<main class="enigmatic-main">
  <h1>Bienvenue sur EGNIMAXION</h1>
  <p>Plongez dans un univers d'énigmes captivantes et de défis intellectuels. Que vous soyez un amateur de puzzles ou un passionné de casse-têtes, EGNIMAXION est votre destination ultime pour tester vos compétences et stimuler votre esprit.</p>
  <p>Explorez notre collection variée d'énigmes, participez à des compétitions palpitantes, et connectez-vous avec une communauté de passionnés partageant les mêmes intérêts. Préparez-vous à relever des défis, à découvrir des solutions ingénieuses, et à vivre une expérience enrichissante.</p>
  <p>Rejoignez-nous dès aujourd'hui et commencez votre aventure au cœur du mystère avec EGNIMAXION!</p>
  <p>Ne pas oubliez de vous inscrire ou de vous connecter pour accéder à toutes les fonctionnalités du site.</p>
</main>

</body>
</html>

<!-- script navigation -->
<script src="nav.js"></script>
<?php
?>