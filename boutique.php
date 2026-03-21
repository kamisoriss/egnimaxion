<!--
  Fichier : boutique.php
  Rôle : page de boutique/achats. Affiche les articles disponibles et le panier.
  À implémenter : logique d'achat, panier et intégration paiement si nécessaire.
-->
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Boutique - EGNIMAXION</title>
<link href="https://fonts.googleapis.com/css2?family=Unica+One&family=Orbitron:wght@700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="normalize.css">
</head>
<body>
<header class="enigmatic-header">
  <span class="header-bg-puzzle">
    <!-- même SVG décoratif que sur index -->
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
  Boutique
</header>
<nav class="enigmatic-nav">
  <button title="Acceuil" onclick="location.href='index.php'"><span class="nav-icon">🏠</span><span>Acceuil</span></button>
  <button title="Contact" onclick="location.href='contact.php'"><span class="nav-icon">✉️</span><span>Contact</span></button>
  <button title="Commencer" onclick="location.href='niveau/commencer.php'"><span class="nav-icon">🧩</span><span>Commencer</span></button>
  <button title="Boutique" class="active"><span class="nav-icon">🛒</span><span>Boutique</span></button>
  <button title="À venir" class="nav-blank"><span class="nav-icon">?</span><span></span></button>
  <button title="À venir" class="nav-blank"><span class="nav-icon">?</span><span></span></button>
</nav>
<svg class="maze-bg" viewBox="0 0 400 400">
  <circle cx="200" cy="200" r="180" fill="none" stroke="#23262a" stroke-width="16" />
  <circle cx="200" cy="200" r="140" fill="none" stroke="#23262a" stroke-width="8" />
  <path d="M60,200 Q200,60 340,200 Q200,340 60,200 Z" fill="none" stroke="#23262a" stroke-width="6" />
  <path d="M200,60 Q340,200 200,340 Q60,200 200,60 Z" fill="none" stroke="#23262a" stroke-width="6" />
</svg>
<main class="enigmatic-main">
  
</main>
</body>
</html>

<!-- script navigation -->
<script src="nav.js"></script>
