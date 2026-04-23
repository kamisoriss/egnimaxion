<?php
session_start();
if(isset($_SESSION['username']))
{
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Inscription - EGNIMAXION</title>
<link href="https://fonts.googleapis.com/css2?family=Unica+One&family=Orbitron:wght@700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="normalize.css">
    <script src="script/audio.js"></script>
    <script src="script/box.js"></script>
</head>
<body>
<div class="maze-bg"></div>
<header class="enigmatic-header">
    <span class="header-bg-puzzle">
        <audio id="musique-fond" src="assets/sound/egnimaxion_backsound.mp3" loop></audio>
    </span>
        <h1>inscription</h1>
    </header>
<?php
include ('nav.php');
?>
<main class="enigmatic-main">
	<h1>Créer un compte</h1>
	<form class="inscription" action="" method="post">
		<label>Pseudo<input id="username" name="username" type="text" required /></label>
		<label ><br>Email<input id="email" name="email" type="email" required /></label>
		<label ><br>Mot de passe<input id="password" name="password" type="password" required /></label>
        <label><br>Confirmation mot de passe<input type="password" name="confirm_password" required></label>
		<input type="submit" value="S'inscrire" name="inscrir">
	</form>
    <?php
    require_once('php/bdd.php');
    $bdd = conexionbdd();
    if (isset($_POST['inscrir'])) {
        if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
            if ($_POST['password'] === $_POST['confirm_password']) {
                $check = $bdd->prepare("SELECT egnim_id_user FROM egnim_compte WHERE egnim_username = ? OR egnim_usermail = ?");
                $check->execute([$_POST['username'], $_POST['email']]);
                if ($check->rowCount() > 0) {
                    echo "Ce compte existe déja";
                }
                else {
                    $hach_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $request = $bdd->prepare("INSERT INTO egnim_compte (egnim_username, egnim_password_user,egnim_usermail) VALUES (?,?, ?)");
                    $request->execute([
                            $_POST['username'],
                            $hach_password,
                            $_POST['email']
                    ]);

                    echo "<p>Compte créé avec succès !</p>";
                    echo "<script>
                           setTimeout(function(){
                               window.location.href = 'index.php';
                           }, 2000);
                           </script>";
                }
            } else {
                echo "Les mots de passe ne correspondent pas.";
            }
        } else {
            echo "Veuillez remplir tous les champs.";
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
</body>
<script src="script/nav.js"></script>
</html>
