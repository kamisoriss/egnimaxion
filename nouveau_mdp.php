<?php
/*
 * Copyright (c) 2026 EGNIMAXION. Tous droits réservés.
 *
 * Ce fichier fait partie du projet Egnimaxion.
 * Toute reproduction, distribution, modification ou utilisation
 * non autorisée de ce code est strictement interdite.
 */

session_start();
require_once ('php/bdd.php');
$bdd = conexionbdd();
include 'header.php';
?>
<main class="enigmatic-main">
    <h1>réinitialiser le mot de passe</h1>

    <?php
    $message = "";
    if (isset($_POST['confirm_new_password'])) {
        if (!empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
            if ($_POST['new_password'] === $_POST['confirm_password']) {

                if (isset($_GET['token'])) {
                    $token_recu = $_GET['token'];

                    $req = $bdd->prepare("SELECT egnim_id_user FROM egnim_compte WHERE egnim_reset_token = ? AND egnim_reset_expires > NOW()");
                    $req->execute([$token_recu]);
                    $user = $req->fetch();

                    if ($user) {
                        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                        $update = $bdd->prepare("UPDATE egnim_compte SET egnim_password_user = ?, egnim_reset_token = NULL, egnim_reset_expires = NULL WHERE egnim_id_user = ?");
                        $update->execute([$new_password, $user['egnim_id_user']]);
                        $message = "<p style='color: #00ffff; font-weight: bold;'>Votre mot de passe a été modifié avec succès ! Vous pouvez maintenant retourner à l'accueil pour vous connecter.</p>";
                        echo "<meta http-equiv='refresh' content='1; url=index.php' />";
                    } else {
                        $message = "<p style='color: red;'>Erreur : Ce lien de réinitialisation est invalide ou a expiré.</p>";
                    }
                } else {
                    $message = "<p style='color: red;'>Erreur : Aucun lien de sécurité détecté.</p>";
                }
            } else {
                $message = "<p style='color: red;'>Erreur : Les deux mots de passe ne sont pas identiques.</p>";
            }
        } else {
            $message = "<p style='color: red;'>Erreur : Veuillez remplir tous les champs.</p>";
        }
    }
    ?>

    <?= $message ?>

    <form method="post">
        <label>nouveau mot de passe <input type="password" name="new_password" required></label>
        <label><br>confirmer mot de passe<input type="password" name="confirm_password" required></label>
        <br><input type="submit" name="confirm_new_password" value="confirmer">
    </form>
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
    <?php include 'footer.php'; ?>
</footer>

<script src="script/nav.js"></script>
</body>
</html> sino nsa viens pet être du nouvea mot de passe qui marche pas poru la conexion normal j'ai esayer de le changer mais la page a l'ir de rien fair