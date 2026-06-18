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
include 'header.php';
?>
<main class="enigmatic-main">
    <div class="legal-box">
        <h1>Conditions Générales d'Utilisation</h1>

        <section>
            <h2>1. Objet</h2>
            <p>Les présentes CGU ont pour objet de définir les modalités de mise à disposition du jeu EGNIMAXION et les conditions d'utilisation du service par l'Utilisateur.</p>
        </section>

        <section>
            <h2>2. Accès au service</h2>
            <p>Le site est accessible gratuitement à tout utilisateur disposant d'un accès à internet. L'éditeur s'efforce de maintenir le site accessible 24h/24, mais n'est pas tenu à une obligation de résultat (maintenance, pannes serveurs, etc.).</p>
        </section>

        <section>
            <h2>3. Règles de conduite et Anti-triche</h2>
            <p>En créant un compte, l'utilisateur s'interdit :</p>
            <ul>
                <li>De tenter d'injecter du code malveillant (SQL injection, XSS) dans les formulaires.</li>
                <li>De modifier manuellement les valeurs de la monnaie virtuelle en base de données.</li>
                <li>D'usurper l'identité d'un autre joueur.</li>
            </ul>
        </section>

        <section>
            <h2>4. Propriété intellectuelle</h2>
            <p>Tous les éléments du site (énigmes, graphismes, sons générés par IA) sont protégés. Toute reproduction totale ou partielle sans autorisation est interdite.</p>
        </section>

        <section>
            <h2>5. Sanctions</h2>
            <p>Tout manquement aux règles précitées pourra entraîner la suppression immédiate et définitive du compte de l'utilisateur, sans avertissement ni compensation.</p>
        </section>
    </div>
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
</html>
