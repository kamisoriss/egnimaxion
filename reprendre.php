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
/**
 *
 */
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
if (isset($_SESSION['username'])) {


    $reqsave = $bdd->prepare("select * from egnim_compte where egnim_username = ?");
    $reqsave->execute(array($_SESSION['username']));
    $reqsavefetch = $reqsave->fetch(PDO::FETCH_ASSOC);
    if ($reqsavefetch) {
        $requestresult = $reqsavefetch['egnim_save'];
        if ($requestresult == 1) {
            header("Location: niveau/commencer.php");
            exit();

    }elseif ($requestresult == 2)
    {
        header('Location: niveau/level2.php');
        exit();
    }
    elseif ($requestresult == 3)
    {
        header('Location: niveau/level3.php');
        exit();
    }
    }
}else{
    header("Location: index.php");
    exit();
}
?>