<?php
session_start();

// --- 1. LE CERVEAU (LOGIQUE DE PASSAGE AU NIVEAU 2) ---
// On vérifie si le formulaire que tu m'as montré a été envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'unlock') {

    // On vérifie si le token est le bon (Sécurité)
    if (($_POST['csrf_token'] ?? '') === ($_SESSION['csrf_token'] ?? '')) {
        $_SESSION['level1_completed'] = true; // On valide le niveau
        header('Location: level2.php');     // On change de page
        exit;
    } else {
        $error = "Erreur de sécurité (Token)";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Niveau 1 - EGNIMAXION</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<?php include ('../nav.php'); ?>

<svg class="maze-bg" viewBox="0 0 400 400">
    <circle cx="200" cy="200" r="180" fill="none" stroke="#23262a" stroke-width="16" />
    <circle cx="200" cy="200" r="140" fill="none" stroke="#23262a" stroke-width="8" />
    <path d="M60,200 Q200,60 340,200 Q200,340 60,200 Z" fill="none" stroke="#23262a" stroke-width="6" />
    <path d="M200,60 Q340,200 200,340 Q60,200 200,60 Z" fill="none" stroke="#23262a" stroke-width="6" />
</svg>
<header class="enigmatic-header">
    <span class="header-bg-puzzle">
  </span>
    <h1>level 1</h1>
</header>
<main class="enigmatic-main">
    <h1>niveau 1</h1>

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
        <div>Error: <?= htmlspecialchars($error ?? 'Aucune') ?></div>
        <div>CSRF token: <?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?></div>
    </div>
<?php endif; ?>

<script src="../nav.js"></script>
</body>
</html>