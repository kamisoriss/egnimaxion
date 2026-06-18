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
        <h1>Mentions Légales & Conditions d'Utilisation</h1>

        <section>
            <h2>1. Édition du site</h2>
            <p>Le site <strong>EGNIMAXION</strong> est édité par :
                <br>Contact : <a href="mailto:kamisoris@kamisoris.fr" class="contact-mail">kamisoris@kamisoris.fr</a></p>
            <p><em>L'éditeur est anonyme conformément à la loi (Article 6-III-2 de la LCEN). Identité transmise en toute confidentialité à l'hébergeur.</em></p>
        </section>

        <section>
            <h2>2. Hébergement</h2>
            <p>Le site est hébergé par la société <strong>IONOS SARL</strong> :
                <br>7 place de la Gare, BP 70109, 57200 Sarreguemines Cedex
                <br>Téléphone : 09 70 80 89 11</p>
        </section>

        <section>
            <h2>3. Propriété intellectuelle</h2>
            <p>La structure générale du site, les codes sources (HTML/CSS/JS/PHP), le design graphique "Egnimaxion" et la mise en scène interactive des énigmes sont la propriété exclusive de l'éditeur.</p>
        </section>

        <section>
            <h2>4. Politique de Confidentialité (RGPD)</h2>
            <p>Dans le cadre de son système de compte, EGNIMAXION collecte les données suivantes :</p>
            <ul>
                <li><strong>Identifiant (Pseudo) :</strong> Utilisé pour vous identifier sur le site.</li>
                <li><strong>Mot de passe :</strong> Stocké sous forme de <strong>hachage cryptographique</strong> (impossible à lire en clair).</li>
                <li><strong>Progression :</strong> Sauvegarde de vos étapes franchies.</li>
            </ul>
            <p><strong>Finalité :</strong> Ces données servent uniquement au bon fonctionnement du jeu et à la sauvegarde de votre aventure. Aucune donnée n'est cédée ou vendue à des tiers.</p>
            <p><strong>Droit des utilisateurs :</strong> Vous pouvez demander la suppression de votre compte et de toutes vos données par simple mail à l'adresse de contact susmentionnée.</p>
        </section>

        <section>
            <h2>5. Utilisation des Cookies</h2>
            <p>Le site utilise des cookies strictement nécessaires :
            <ul>
                <li><strong>Cookie de Session :</strong> Permet de vous maintenir connecté pendant votre navigation.</li>
                <li><strong>Cookie Technique :</strong> Mémorise vos paramètres (volume sonore, état du menu).</li>
            </ul>
            Ces cookies sont exemptés de consentement car ils sont indispensables à la fourniture du service de jeu demandé par l'utilisateur.</p>
        </section>

        <section>
            <h2>6. Boutique et Monnaie Virtuelle</h2>
            <p>La boutique présente sur EGNIMAXION utilise une monnaie de jeu fictive obtenue par la réussite d'énigmes.
                <br>Cette monnaie n'a <strong>aucune valeur monétaire réelle</strong>. Elle ne peut être ni achetée avec de l'argent réel, ni remboursée, ni échangée contre des biens physiques.</p>
            <h2>8. Responsabilité</h2>
            <p>L'éditeur ne pourra être tenu responsable des bugs, interruptions de service ou dommages causés au matériel de l'utilisateur. Le contenu généré par IA (Gemini/Lyria) est utilisé à titre artistique et immersif.</p>
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
