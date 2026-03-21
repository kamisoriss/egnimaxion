<?php
// Contrôle d'accès au niveau 2 : s'assurer que l'utilisateur ait complété le niveau 1
session_start();
// Exemple : la page qui valide l'énigme du niveau 1 doit définir
// $_SESSION['level1_completed'] = true; après validation réussie.
if (empty($_SESSION['level1_completed'])) {
  // rediriger vers la page de démarrage / niveau 1
  header('Location: ../niveau/commencer.php');
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
    <svg width="340" height="100" viewBox="0 0 340 100" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <path d="M30 20 q-10 10 0 20 q10 10 20 0 q-5 -5 0 -10 q5 -5 0 -10 q-10 -10 -20 0 Z" fill="#23262a" stroke="#444" stroke-width="2.5" opacity="0.45"/>
      <path d="M80 60 q-8 8 0 16 q8 8 16 0 q-4 -4 0 -8 q4 -4 0 -8 q-8 -8 -16 0 Z" fill="#23262a" stroke="#444" stroke-width="2.5" opacity="0.38"/>
      <path d="M140 30 q-10 10 0 20 q10 10 20 0 q-5 -5 0 -10 q5 -5 0 -10 q-10 -10 -20 0 Z" fill="#23262a" stroke="#444" stroke-width="2.5" opacity="0.32"/>
      <path d="M200 65 q-8 8 0 16 q8 8 16 0 q-4 -4 0 -8 q4 -4 0 -8 q-8 -8 -16 0 Z" fill="#23262a" stroke="#444" stroke-width="2.5" opacity="0.35"/>
      <path d="M260 18 q-10 10 0 20 q10 10 20 0 q-5 -5 0 -10 q5 -5 0 -10 q-10 -10 -20 0 Z" fill="#23262a" stroke="#444" stroke-width="2.5" opacity="0.28"/>
      <path d="M290 60 q-8 8 0 16 q8 8 16 0 q-4 -4 0 -8 q4 -4 0 -8 q-8 -8 -16 0 Z" fill="#23262a" stroke="#444" stroke-width="2.5" opacity="0.22"/>
      <path d="M60 10 q-6 6 0 12 q6 6 12 0 q-3 -3 0 -6 q3 -3 0 -6 q-6 -6 -12 0 Z" fill="#23262a" stroke="#444" stroke-width="1.5" opacity="0.22"/>
      <path d="M110 80 q-5 5 0 10 q5 5 10 0 q-2.5 -2.5 0 -5 q2.5 -2.5 0 -5 q-5 -5 -10 0 Z" fill="#23262a" stroke="#444" stroke-width="1.5" opacity="0.18"/>
      <path d="M180 10 q-7 7 0 14 q7 7 14 0 q-3.5 -3.5 0 -7 q3.5 -3.5 0 -7 q-7 -7 -14 0 Z" fill="#23262a" stroke="#444" stroke-width="1.5" opacity="0.16"/>
      <path d="M320 40 q-6 6 0 12 q6 6 12 0 q-3 -3 0 -6 q3 -3 0 -6 q-6 -6 -12 0 Z" fill="#23262a" stroke="#444" stroke-width="1.5" opacity="0.13"/>
      <path d="M220 90 q-5 5 0 10 q5 5 10 0 q-2.5 -2.5 0 -5 q2.5 -2.5 0 -5 q-5 -5 -10 0 Z" fill="#23262a" stroke="#444" stroke-width="1.5" opacity="0.12"/>
    </svg>
  </span>
    <span></span>
  </header>
  <nav class="enigmatic-nav collapsible">
    <div class="nav-toggle" tabindex="0">
      <span class="arrow">&rsaquo;</span>
    </div>
    <div class="nav-content">
      <button title="Acceuil" onclick="location.href='../index.php'"><span class="nav-icon">🏠</span><span>Acceuil</span></button>
      <button title="Connexion" onclick="location.href='../connexion.php'"><span class="nav-icon">🧾</span><span>Connexion</span></button>
      <button title="Commencer" onclick="location.href='../niveau/commencer.php'"><span class="nav-icon">🧩</span><span>Commencer</span></button>
      <button title="Boutique" onclick="location.href='../boutique.php'"><span class="nav-icon">🛒</span><span>Boutique</span></button>
      <button title="Contact" onclick="location.href='../contact.php'"><span class="nav-icon">✉️</span><span>Contact</span></button>
    </div>
  </nav>
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