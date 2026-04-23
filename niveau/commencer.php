<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'unlock') {

if (($_POST['csrf_token'] ?? '') === ($_SESSION['csrf_token'] ?? '')) {

$_SESSION['level1_completed'] = true;

if (isset($_SESSION['username'])) {
require_once('../php/bdd.php');
$bdd = conexionbdd();
$update = $bdd->prepare("UPDATE egnim_compte SET egnim_save = 1 WHERE egnim_username = ?");
$update->execute([$_SESSION['username']]);
}

header('Location: level2.php');
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
    <script src="../script/audio.js"></script>
</head>
<body>
<div class="maze-bg"></div>
<?php include ('../nav.php'); ?>
<header class="enigmatic-header">
    <span class="header-bg-puzzle">
        <audio id="musique-fond" src="../assets/sound/egnimaxion_backsound.mp3" loop></audio>
  </span>
    <h1>level 1</h1>
</header>
<main class="enigmatic-main mode-niveau">
    <h1>niveau 1</h1>

    <form method="post" action="commencer.php" style="display:inline;">
        <input type="hidden" name="action" value="unlock">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES) ?>">
        <button class="level1" type="submit" aria-label="Accéder au niveau 2"></button>
    </form>
</main>
<div id="controles-volume">
    <button id="bouton-mute">
        <img src="../assets/img/soundplay.png" alt="Volume" id="icone-volume-on" class="icone show" draggable="false">
        <img src="../assets/img/soundstop.png" alt="Mute" id="icone-volume-off" class="icone" draggable="false">
    </button>

    <div class="curseur-piste" id="volume-piste">
        <img src="../assets/img/soundbar.png" alt="Piste" class="piste-vide" draggable="false">

        <div class="remplissage-barre" id="remplissage-barre">
            <img src="../assets/img/soundbarfill.png" alt="Remplissage" class="barre-pleine" draggable="false">
        </div>

        <img src="../assets/img/soundbarcursor.png" alt="Curseur" class="curseur-rond" id="curseur-rond" draggable="false">
    </div>

    <span id="volume-texte">15%</span>
</div>

<footer>

    <ul><li><a class="legal-link" href="../mention_legal.php">Mention légale</a></li></ul>
    <ul><li>><a class="legal-link" href="../cgu.php"></a></li></ul>
</footer>
<?php if (isset($_GET['dev']) && $_GET['dev'] == '1') : ?>
    <div style="position:fixed;right:12px;bottom:12px;background:#111;color:#efe;padding:12px;border:1px solid #333;z-index:9999;font-family:monospace;">
        <div><strong>DEV</strong></div>
        <div>Session level1_completed: <?= isset($_SESSION['level1_completed']) ? 'true' : 'false' ?></div>
        <div>Error: <?= htmlspecialchars($error ?? 'Aucune') ?></div>
        <div>CSRF token: <?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?></div>
    </div>
<?php endif; ?>
</body>
<script src="../script/nav.js"></script>
</html>