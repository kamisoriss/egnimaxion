<?php
session_start();
require_once ('php/bdd.php');
$bdd = conexionbdd();
$message_erreur = "";
if (isset($_POST['disconnect'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
if (isset($_POST['validé'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $request = $bdd->prepare("select * from egnim_compte where egnim_username = ?");
        $request->execute(array($_POST['username']));
        $requestresult = $request->fetch();

        if ($requestresult && password_verify($_POST['password'], $requestresult['egnim_password_user'])) {
            $_SESSION['username'] = $requestresult['egnim_username'];
            header("Location: index.php");
            exit;
        } else {
            $message_erreur = "<p style='color:red;'>Identifiant ou mot de passe incorrect</p>";
        }
    } else {
        $message_erreur = "<p style='color:red;'>Veuillez remplir toutes les cases</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Boutique - EGNIMAXION</title>
<link href="https://fonts.googleapis.com/css2?family=Unica+One&family=Orbitron:wght@700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="normalize.css">
    <script src="script/audio.js"></script>
    <script src="script/box.js"  defer></script>
</head>
<body>
<div class="maze-bg"></div>
<header class="enigmatic-header">
    <span class="header-bg-puzzle">
        <audio id="musique-fond" src="assets/sound/egnimaxion_backsound.mp3" loop></audio>
    </span>
    <h1>boutique</h1>
</header>
<div id="login-box">
    <button id="login-open-box-buton"><img src="assets/img/log-login.png" alt="logo-login"></button>
    <div id="login-open-box">
        <?php
        if (isset($_SESSION['username'])) {
            echo "<p>Connecté en tant que :</p><p style='color:#00ffff; font-size:1.2em;'>" . htmlspecialchars($_SESSION['username']) . "</p>";
            echo "<form method='post'><br><button name='disconnect'>Déconnexion</button></form>";
        }
        else {
            ?>
                <div id="form-login">
            <p>Connexion</p>
            <?= $message_erreur ?>
            <form method="post">
                <label>identifiant:<input type="text" name="username"></label>
                <label>mot de passe:<input type="password" name="password"></label>
                <div class="btn-row">
                    <input type="submit" name="validé" value="connexion">
                    <a href="inscription.php" id="inscription">s'inscrire</a>
                    <button type="button" id="forgetpassword">mot de passe oublié</button>
                </div>
            </form>
                </div>
            <div id="forgetpasswordbox" style="display: none;">
                <p>Réinitialiser le mot de passe</p>
                <div id="message-retour"></div>
                <form method="post" id="password-reset">
                    <label>Votre email:<input type="email" name="email" required></label>
                    <div class="btn-row">
                        <input type="submit" name="reset" value="Envoyer">
                        <button type="button" id="connexionbox">connexion</button>
                    </div>
                </form>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php
include ('nav.php');
?>
<main class="enigmatic-main">
  
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
</body>
</html>

<!-- script navigation -->
<script src="script/nav.js"></script>
