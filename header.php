<?php
/*
 * Copyright (c) 2026 EGNIMAXION. Tous droits réservés.
 *
 * Ce fichier fait partie du projet Egnimaxion.
 * Toute reproduction, distribution, modification ou utilisation
 * non autorisée de ce code est strictement interdite.
 */

// On sécurise les variables pour éviter les erreurs
if (!isset($titre_page)) { $titre_page = "EGNIMAXION"; }
if (!isset($titre_header)) { $titre_header = "EGNIMAXION"; }
if (!isset($chemin)) { $chemin = ""; }

// --- 1. GESTION DE LA CONNEXION GLOBALISÉE ---
$message_erreur = "";

// Déconnexion
if (isset($_POST['disconnect'])) {
    session_destroy();
    header("Location: " . $chemin . "index.php");
    exit;
}

// Connexion classique
if (isset($_POST['validé'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // On s'assure que $bdd existe (il doit être défini dans la page principale)
        global $bdd;

        $request = $bdd->prepare("SELECT * FROM egnim_compte WHERE egnim_username = ?");
        $request->execute(array($_POST['username']));
        $requestresult = $request->fetch();

        if ($requestresult && password_verify($_POST['password'], $requestresult['egnim_password_user'])) {
            $_SESSION['username'] = $requestresult['egnim_username'];
            // On recharge la page ACTUELLE (Boutique, Niveau 2, etc.)
            header("Location: " . $_SERVER['REQUEST_URI']);
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
    <head>        <meta charset="UTF-8">        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $titre_page ?></title>
        <link rel="stylesheet" href="<?= $chemin ?>normalize.css">
        <link href="https://fonts.googleapis.com/css2?family=Unica+One&family=Orbitron:wght@700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= $chemin ?>style.css">
        <script src="<?= $chemin ?>script/audio.js"></script>
            <script src="<?= $chemin ?>script/box.js" defer></script>
        <script>document.addEventListener('mousedown', function() {
                // Cette ligne vide la sélection de texte actuelle au moment du clic
                window.getSelection().removeAllRanges();
            });</script>
    </head>
<body>
<div class="maze-bg"></div>

<!-- --- 2. LE HEADER VISUEL --- -->
<header class="enigmatic-header">
    <span class="header-bg-puzzle">
        <audio id="musique-fond" src="<?= $chemin ?>assets/sound/egnimaxion_backsound.mp3" loop></audio>
    </span>
    <h1><?= $titre_header ?></h1>
</header>

<?php
if (!isset($niveau)) {$niveau= false;}
    ?>
<div id="login-box" style="position: fixed; right: 3%; top: 5%; z-index: 5;">

    <button id="login-open-box-buton" style="background: transparent; border: none; padding: 0; cursor: pointer; outline: none;">

        <?php if (!empty($_SESSION['avatar_url'])): ?>
            <img src="<?= htmlspecialchars($_SESSION['avatar_url']) ?>" alt="Avatar" style="width: 70px; height: 70px; border-radius: 12px; border: 2px solid #00ffff; box-shadow: 0 0 25px 5px #930101, 0 0 10px 2px rgb(255, 0, 0); object-fit: cover; filter: none !important;">
        <?php else: ?>
            <img src="<?= $chemin ?>assets/img/log-login.png" alt="logo-login" style="width: 130px; height: auto; filter: drop-shadow(0 0 15px #930101) drop-shadow(0 0 5px rgb(255, 0, 0));">

        <?php endif; ?>

    </button>

    <div id="login-open-box">

        <?php if (isset($_SESSION['username'])){ ?>
            <p>Connecté en tant que :</p>
            <p style='color:#00ffff; font-size:1.2em;'><?= htmlspecialchars($_SESSION['username']) ?></p>
        <?php if (!$niveau){?>
            <form method='post'><br><button name='disconnect'>Déconnexion</button></form>
        <?php }}
            else{ ?>
                <div id="form-login">
                    <p>Connexion</p>
                    <?= $message_erreur ?>
                    <form method="post">
                        <label>identifiant:<input type="text" name="username"></label>
                        <label>mot de passe:<input type="password" name="password"></label>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 20px; width: 100%;">

                            <input type="submit" name="validé" value="connexion" style="padding: 10px 5px; font-size: 13px; box-sizing: border-box; text-align: center; cursor: pointer;">

                            <a href="<?= $chemin ?>inscription.php" id="inscription" style="padding: 10px 5px; font-size: 13px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; text-align: center; cursor: pointer;">s'inscrire</a>

                            <a href="<?= $chemin ?>google_login.php" style="background: #ffffff; color: #000000; border: 1px solid #ccc; font-family: 'Orbitron', sans-serif; font-size: 10px; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 8px 4px; box-sizing: border-box; cursor: pointer;">
                                <img src="https://www.google.com/favicon.ico" alt="G" style="width: 18px; height: 18px; flex-shrink: 0;">
                                <span style="text-align: left; line-height: 1.3;">se connecter /<br>s'inscrire avec<br><b>Google</b></span>
                            </a>

                            <a href="<?= $chemin ?>discord_login.php" style="background: #ffffff; color: #000000; border: 1px solid #ccc; font-family: 'Orbitron', sans-serif; font-size: 10px; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 8px 4px; box-sizing: border-box; cursor: pointer;">
                                <img src="https://upload.wikimedia.org/wikipedia/fr/thumb/4/4f/Discord_Logo_sans_texte.svg/1920px-Discord_Logo_sans_texte.svg.png" alt="D" style="width: 18px; height: 18px; flex-shrink: 0; object-fit: contain;">
                                <span style="text-align: left; line-height: 1.3;">se connecter /<br>s'inscrire avec<br><b>Discord</b></span>
                            </a>

                        </div>

                        <div style="margin-top: 12px; text-align: center;">
                            <button type="button" id="forgetpassword" style="background:none; border:none; color:#00ffff; text-decoration:underline; cursor:pointer; font-family:'Share Tech Mono', sans-serif;">mot de passe oublié</button>
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
        <?php }?>
    </div>
</div>
<?php
// --- 4. LA NAVIGATION ---
// On inclut la nav directement ici puisqu'elle suit toujours le header !
include ($chemin . 'nav.php');
?>
</body>
