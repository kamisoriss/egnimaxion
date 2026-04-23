<?php
session_start();
require_once ('php/bdd.php');
$bdd = conexionbdd();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>  EGNIMAXION</title>
    <link rel="stylesheet" href="normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Unica+One&family=Orbitron:wght@700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="script/audio.js"></script>
    <script src="script/box.js"></script>
</head>
<body>
<div class="maze-bg"></div>
<header class="enigmatic-header">
    <span class="header-bg-puzzle">
        <audio id="musique-fond" src="assets/sound/egnimaxion_backsound.mp3" loop></audio>
  </span>
    <h1>EGNIMAXION</h1>
</header>
<main class="enigmatic-main">
   <h1>réinitialiser le mot de passe</h1>
    <form method="post">
        <label>nouveau mot de passe <input type="password" name="new_password" required></label>
        <label><br>confirmer mot de passe<input type="password" name="confirm_password" required></label>
        <br><input type="submit" name="confirm_new_password" value="confirmer">
    </form>
    <?php
    if (isset($_POST['confirm_new_password']))
    {
        if (!empty($_POST['new_password']) && !empty($_POST['confirm_password']))
        {
            if ($_POST['new_password'] == $_POST['confirm_password'])
            {
                $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                $token_recu = htmlspecialchars($_GET['token']);
                $req = $bdd->prepare("SELECT egnim_id_user FROM egnim_compte WHERE egnim_reset_token = ? AND egnim_reset_expires > NOW()");
                $req->execute([$token_recu]);
                $user = $req->fetch();
            }
        }
    }
    ?>
</main>
<div id="controles-volume">
    <button id="bouton-mute">
        <img src="assets/img/soundplay.png" alt="Volume" id="icone-volume-on" class="icone show" draggable="false">
        <img src="assets/img/soundstop.png" alt="Mute" id="icone-volume-off" class="icone" draggable="false">
    </button>

    <div class="curseur-piste" id="volume-piste">
        <img src="assets/img/soundbar.png" alt="Piste" class="piste-vide" draggable="false">

        <div class="remplissage-barre" id="remplissage-barre">
            <img src="assets/img/soundbarfill.png" alt="Remplissage" class="barre-pleine" draggable="false">
        </div>

        <img src="assets/img/soundbarcursor.png" alt="Curseur" class="curseur-rond" id="curseur-rond" draggable="false">
    </div>

    <span id="volume-texte">15%</span>
</div>

<footer>

    <ul><li><a class="legal-link" href="mention_legal.php">Mention légale</a></li></ul>
    <ul><li>><a class="legal-link" href="cgu.php">Conditions Générales d'Utilisation</a></li></ul>
</footer>

<script src="script/nav.js"></script>
</body>
</html>