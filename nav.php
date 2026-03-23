<?php
// 1. On récupère le chemin du dossier actuel (ex: /niveau ou /admin/settings)
$directory = trim(dirname($_SERVER['SCRIPT_NAME']), '/');

// 2. On compte combien de sous-dossiers il y a
// Si on est à la racine, $depth sera 0. Si on est dans /niveau, $depth sera 1.
$depth = ($directory === "") ? 0 : count(explode('/', $directory));

// 3. On génère la variable de racine (ex: ../ ou ../../ ou rien)
$root = str_repeat('../', $depth);
?>
<nav class="enigmatic-nav collapsible">
    <div class="nav-toggle" tabindex="0">
        <span class="arrow">&rsaquo;</span>
    </div>
    <div class="nav-content">
        <a href="<?= $root ?>index.php" class="nav-btn-link" title="Accueil">
            <span class="nav-icon">🏠</span><span>Accueil</span>
        </a>
        <a href="<?= $root ?>contact.php" class="nav-btn-link" title="Contact">
            <span class="nav-icon">✉️</span><span>Contact</span>
        </a>
        <a href="<?= $root ?>niveau/commencer.php" class="nav-btn-link" title="Commencer">
            <span class="nav-icon">🧩</span><span>Commencer</span>
        </a>
        <a href="<?= $root ?>boutique.php" class="nav-btn-link" title="Boutique">
            <span class="nav-icon">🛒</span><span>Boutique</span>
        </a>
    </div>
</nav>