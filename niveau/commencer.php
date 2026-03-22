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
$_SESSION['last_activity'] = time();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['level1_completed'] = false;
    // Optionnel : session_destroy(); // Si tu veux vraiment tout effacer
}
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
<div class="maze-bg"></div>
<?php include ('../nav.php'); ?>
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