<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Unica+One&family=Orbitron:wght@700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="script/audio.js"></script>
    <title>mention légal</title>
</head>
<body>
<div class="maze-bg"></div>
<header class="enigmatic-header">
    <span class="header-bg-puzzle">
        <audio id="musique-fond" src="assets/sound/egnimaxion_backsound.mp3" loop></audio>
    </span>
    <h1>EGNIMAXION</h1>
</header>
<?php
include ('nav.php');
?>
<main class="enigmatic-main">
    <div class="legal-box">
        <h1>Mentions Légales</h1>

        <section>
            <h2>1. Édition du site</h2>
            <p>Le site <strong>EGNIMAXION</strong> est édité par :
                <br>Contact : <a href="mailto:kamisoris@kamisoris.fr" class="contact-mail">kamisoris@kamisoris.fr</a></p>
            <em>L'éditeur est anonyme conformément à la loi. Identité transmise à l'hébergeur.</em>
        </section>

        <section>
            <h2>2. Hébergement</h2>
            <p>Le site est hébergé par la société <strong>IONOS SARL</strong> :
                <br>7 place de la Gare, BP 70109, 57200 Sarreguemines Cedex
                <br>Téléphone : 09 70 80 89 11</p>
        </section>

        <section>
            <h2>3. Propriété intellectuelle</h2>
            <p><br>La structure générale du site, ainsi que les codes sources, le design graphique et la mise en scène des énigmes sont la propriété de EGNIMAXION. Concernant les énigmes elles-mêmes, elles sont issues du domaine public ou utilisées à titre illustratif ; toutefois, leur intégration interactive et leur scénarisation sur ce site restent protégées.</p>
        </section>

        <section>
            <h2>4. Données personnelles et Cookies</h2>
            <p>EGNIMAXION n'utilise aucun système de compte ni de collecte de données publicitaires.</p>
            <p>L'utilisateur est informé que des <strong>cookies de session</strong> sont utilisés pour :
            <ul>
                <li>Mémoriser la progression dans les énigmes.</li>
                <li>Assurer le bon fonctionnement technique du site.</li>
            </ul>
            Ces cookies sont temporaires et disparaissent à la fermeture de la session. Conformément aux directives de la CNIL, ils sont exemptés de consentement préalable car strictement nécessaires au service.</p>
        </section>
        <section>
            <h2>5. Responsabilité</h2>
            <p>L'éditeur ne pourra être tenu responsable des dommages directs ou indirects causés au matériel de l’utilisateur lors de l’accès au site, ou de l’apparition d’un bug ou d’une incompatibilité.</p>
        </section>
        <section>
            <h2>6. Boutique virtuelle et Monnaie de jeu</h2>
            <p>Le site peut proposer une "boutique" utilisant une monnaie virtuelle propre au jeu EGNIMAXION.
                <br>Cette monnaie est obtenue exclusivement par la progression dans les énigmes et n'a <strong>aucune valeur monétaire réelle</strong>.
                Elle ne peut en aucun cas être convertie, remboursée ou échangée contre de l'argent réel ou des biens matériels.</p>
        </section>
        <section>
            <h2>7. Crédits multimédias</h2>
            <p><br>L'ambiance musicale et certaines illustrations présentes sur le site Egnimaxion ont été créées à l'aide de l'intelligence artificielle (modèles génératifs de Google Gemini).
                <br>Elles sont utilisées à des fins d'illustration et d'immersion pour les énigmes du jeu.</p>
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

    <ul><li><a class="legal-link" href="mention_legal.php">Mention légale</a></li></ul>
</footer>
<script src="script/nav.js"></script>
</html>
