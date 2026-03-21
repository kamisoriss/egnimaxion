<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Inscription - EGNIMAXION</title>
<link href="https://fonts.googleapis.com/css2?family=Unica+One&family=Orbitron:wght@700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="normalize.css">
</head>
<body>
<header class="enigmatic-header">
    <header class="enigmatic-header">
        <span class="header-bg-puzzle">
  </span>
        <h1>inscription</h1>
    </header>
</header>
<?php
include ('nav.php');
?>
<svg class="maze-bg" viewBox="0 0 400 400">
	<circle cx="200" cy="200" r="180" fill="none" stroke="#23262a" stroke-width="16" />
	<circle cx="200" cy="200" r="140" fill="none" stroke="#23262a" stroke-width="8" />
	<path d="M60,200 Q200,60 340,200 Q200,340 60,200 Z" fill="none" stroke="#23262a" stroke-width="6" />
	<path d="M200,60 Q340,200 200,340 Q60,200 200,60 Z" fill="none" stroke="#23262a" stroke-width="6" />
</svg>
<main class="enigmatic-main">
	<h1>Créer un compte</h1>
	<form class="signup-form" action="inscription.php" method="post">
		<label for="username">Pseudo</label>
		<input id="username" name="username" type="text" required />

		<label for="email">Email</label>
		<input id="email" name="email" type="email" required />

		<label for="password">Mot de passe</label>
		<input id="password" name="password" type="password" required />

		<button type="submit">S'inscrire</button>
	</form>
</main>

</body>
</html>

<!-- script navigation -->
<script src="nav.js"></script>

<?php

?>
