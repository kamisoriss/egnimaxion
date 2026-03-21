<?php
session_start();
// Si le joueur n'a pas fini le niveau 1, on le renvoie au début
if (!($_SESSION['level1_completed'] ?? false)) {
    header('Location: commencer.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Niveau 2 - EGNIMAXION</title>
  <link href="https://fonts.googleapis.com/css2?family=Unica+One&family=Orbitron:wght@700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../normalize.css">
</head>
<body>
<header class="enigmatic-header">
    <span class="header-bg-puzzle">
  </span>
    <h1>level 2</h1>
</header>
<?php
include ('../nav.php');
?>
  <svg class="maze-bg" viewBox="0 0 400 400">
  <circle cx="200" cy="200" r="180" fill="none" stroke="#23262a" stroke-width="16" />
  <circle cx="200" cy="200" r="140" fill="none" stroke="#23262a" stroke-width="8" />
  <path d="M60,200 Q200,60 340,200 Q200,340 60,200 Z" fill="none" stroke="#23262a" stroke-width="6" />
  <path d="M200,60 Q340,200 200,340 Q60,200 200,60 Z" fill="none" stroke="#23262a" stroke-width="6" />
</svg>
  <main class="enigmatic-main">
    <h1>niveau 2</h1>
    <p>Bienvenue au niveau 2 </p>
  </main>
  <script src="../nav.js"></script>
</body>
</html>