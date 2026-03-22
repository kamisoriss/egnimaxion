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
<div class="maze-bg"></div>
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
