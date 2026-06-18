<?php
require_once('bdd.php');
if (isset($_POST['valider'])) {
    $nom_entreprise = $_POST['nom_entreprise'];
    $nom_recruteur = $_POST['nom_recruteur'];
    $adresse_mail_recruteur = $_POST['email_recruteur'];
    $num_tel_recruteur = $_POST['tel_recruteur'];
    $bdd = connexionbdd();
    $reqverifyentreprise = $bdd->prepare("SELECT * FROM entreprise WHERE nom_entreprise = :nom_entreprise");
    $reqverifyentreprise->execute(array('nom_entreprise' => $nom_entreprise));
    $nom_entreprisereqresult = $reqverifyentreprise->fetch(PDO::FETCH_ASSOC);
    $id_entreprise = $nom_entreprisereqresult['id_entreprise'];
    if ($nom_entreprisereqresult === false)
    {
        $reqinsertentreprise = $bdd->prepare("INSERT INTO entreprise (nom_entreprise) VALUES (:nom_entreprise)");
        $reqinsertentreprise->execute(array('nom_entreprise' => $nom_entreprise));
        $id_entreprise = $bdd->lastInsertId();
    }

    $reqinsertrecruteur = $bdd->prepare("INSERT INTO recruteur (nom_recruteur,email_recruteur,No_téléphone_recruteur,id_entreprise)
                                         VALUES (:nom_recruteur,:email_recruteur,:tel_recruteur,:id_entreprise)");
    $reqinsertrecruteur -> execute(array(
        ':nom_recruteur' => $nom_recruteur,
        ':email_recruteur' => $adresse_mail_recruteur,
        ':tel_recruteur' => $num_tel_recruteur,
        ':id_entreprise' => $id_entreprise
    ));

    header("Location: enregistremnt_information_recruteur.php?success");
    exit();

}
if (isset($_GET['success'])):?>
    <p>Enregistré avec succès</p>

<?php endif; ?>