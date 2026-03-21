<?php
/*
  Fichier : commencer.php
  Rôle : page de démarrage/jeu. Point d'entrée pour commencer les énigmes.
  Compléter avec la logique de sélection de niveaux et d'initialisation de partie.
*/
// Contrôle du résultat de l'énigme pour débloquer le niveau 2
session_start();
$error = '';

// --- CSRF token: generate on GET, validate on POST ---
if (!isset($_SESSION['csrf_token'])) {
  // 16 bytes -> 32 hex chars
  try {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
  } catch (Exception $e) {
    // fallback
    $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(16));
  }
}

// Handle quick unlock POST coming from the level1 button form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'unlock') {
  $tokenOk = isset($_POST['csrf_token']) && hash_equals((string)($_SESSION['csrf_token'] ?? ''), (string)$_POST['csrf_token']);
  if ($tokenOk) {
    // mark level completed and redirect to level2
    $_SESSION['level1_completed'] = true;
    // regenerate/remove token to avoid replay
    unset($_SESSION['csrf_token']);
    header('Location: level2.php');
    exit;
  } else {
    $error = 'Action invalide (token manquant ou expiré). Rechargez la page.';
  }
}

// Normalisation simple (lowercase, remplacer quelques accents)
function normalize_answer($s) {
  // Use mb_strtolower if available; otherwise fall back to strtolower
  $raw = (string)$s;
  if (function_exists('mb_strtolower')) {
    $s = trim(mb_strtolower($raw, 'UTF-8'));
  } else {
    $s = trim(strtolower($raw));
  }
  $map = [
    'à'=>'a','á'=>'a','â'=>'a','ä'=>'a',
    'ç'=>'c',
    'é'=>'e','è'=>'e','ê'=>'e','ë'=>'e',
    'î'=>'i','ï'=>'i',
    'ô'=>'o','ö'=>'o',
    'ù'=>'u','û'=>'u','ü'=>'u',
    'ÿ'=>'y','ñ'=>'n'
  ];
  return strtr($s, $map);
}

// Définissez ici la/les réponse(s) attendue(s) (normalisées)
$expected_answers = [normalize_answer('solution')];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['riddle_answer'])) {
  // Validate CSRF token
  $tokenOk = isset($_POST['csrf_token']) && hash_equals((string)($_SESSION['csrf_token'] ?? ''), (string)$_POST['csrf_token']);
  if (! $tokenOk) {
    $error = 'Action invalide (token manquant ou expiré). Rechargez la page.';
  } else {
    $given = normalize_answer($_POST['riddle_answer']);
    if (in_array($given, $expected_answers, true)) {
      // Bonne réponse -> marquer la session et rediriger
      $_SESSION['level1_completed'] = true;
      // Regenerate token to avoid replay
      unset($_SESSION['csrf_token']);
      header('Location: level2.php');
      exit;
    } else {
      $error = 'Mauvaise réponse — réessayez.';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Niveau 1 - EGNIMAXION</title>
<link href="https://fonts.googleapis.com/css2?family=Unica+One&family=Orbitron:wght@700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="../normalize.css">
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
  Commencer
</header>
<nav class="enigmatic-nav collapsible">
  <div class="nav-toggle" tabindex="0">
    <span class="arrow">&rsaquo;</span>
  </div>
  <div class="nav-content">
  <button title="Acceuil" onclick="location.href='../index.php'"><span class="nav-icon">🏠</span><span>Acceuil</span></button>
  <button title="Contact" onclick="location.href='../contact.php'"><span class="nav-icon">✉️</span><span>Contact</span></button>
  <button title="Commencer" class="active"><span class="nav-icon">🧩</span><span>Commencer</span></button>
  <button title="Boutique" onclick="location.href='../boutique.php'"><span class="nav-icon">🛒</span><span>Boutique</span></button>
    <button title="À venir" class="nav-blank"><span class="nav-icon">?</span><span></span></button>
    <button title="À venir" class="nav-blank"><span class="nav-icon">?</span><span></span></button>
  </div>
</nav>
<svg class="maze-bg" viewBox="0 0 400 400">
  <circle cx="200" cy="200" r="180" fill="none" stroke="#23262a" stroke-width="16" />
  <circle cx="200" cy="200" r="140" fill="none" stroke="#23262a" stroke-width="8" />
  <path d="M60,200 Q200,60 340,200 Q200,340 60,200 Z" fill="none" stroke="#23262a" stroke-width="6" />
  <path d="M200,60 Q340,200 200,340 Q60,200 200,60 Z" fill="none" stroke="#23262a" stroke-width="6" />
</svg>
<main class="enigmatic-main">
  <h1>niveau 1</h1>
  <!-- Formulaire POST sécurisé : seul moyen d'accéder au niveau 2 -->
  <form method="post" action="commencer.php" style="display:inline;">
    <input type="hidden" name="action" value="unlock">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES) ?>">
    <button class="level1" type="submit" aria-label="Accéder au niveau 2"></button>
  </form>
</main>
<?php if (isset($_GET['dev']) && $_GET['dev'] == '1') : ?>
  <div style="position:fixed;right:12px;bottom:12px;background:#111;color:#efe;padding:12px;border:1px solid #333;z-index:9999;font-family:monospace;">
    <div><strong>DEV</strong></div>
    <div>Session level1_completed: <?= isset($_SESSION['level1_completed']) ? 'true' : 'false' ?></div>
    <div>Error: <?= htmlspecialchars($error ?? '') ?></div>
    <div>CSRF token: <?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?></div>
  </div>
<?php endif; ?>
  <!-- script navigation -->
  <script src="../nav.js"></script>
</body>
</html>
