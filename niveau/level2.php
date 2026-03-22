<?php
$isSecure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';

session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => $isSecure, // <-- Devient true en HTTPS, et false en HTTP !
        'httponly' => true,
        'samesite' => 'Lax' // 'Lax' est plus souple si tu passes de HTTP à HTTPS
]);
session_start();
// Si le joueur n'a pas fini le niveau 1, on le renvoie au début
if (!($_SESSION['level1_completed'] ?? false)) {
    header('Location: commencer.php');
    exit;
}
// 2. LE CHRONOMÈTRE ANTI-TRICHE (ex: 2 heures = 7200 secondes)
$timeout = 7200;
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    // S'il s'est écoulé trop de temps, on le vire !
    session_unset();
    session_destroy();
    header('Location: commencer.php');
    exit;
}
// 3. On met à jour l'heure à chaque fois qu'il actualise ou joue
$_SESSION['last_activity'] = time();
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
<div class="maze-bg"></div>
<header class="enigmatic-header">
    <span class="header-bg-puzzle">
  </span>
    <h1>level 2</h1>
</header>
<?php
include ('../nav.php');
?>
  <main class="enigmatic-main">
    <h1>niveau 2</h1>
    <p>Bienvenue au niveau 2 </p>
  </main>
  <script src="../nav.js"></script>
</body>
</html>