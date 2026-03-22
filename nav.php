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
        <button title="Accueil" onclick="location.href='<?= $root ?>index.php'"><span class="nav-icon">🏠</span><span>Accueil</span></button>
        <button title="Contact" onclick="location.href='<?= $root ?>contact.php'"><span class="nav-icon">✉️</span><span>Contact</span></button>
        <button title="Commencer" onclick="location.href='<?= $root ?>niveau/commencer.php'"><span class="nav-icon">🧩</span><span>Commencer</span></button>
        <button title="Boutique" onclick="location.href='<?= $root ?>boutique.php'"><span class="nav-icon">🛒</span><span>Boutique</span></button>
    </div>
</nav>