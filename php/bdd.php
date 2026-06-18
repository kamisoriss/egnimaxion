<?php
/*
 * Copyright (c) 2026 EGNIMAXION. Tous droits réservés.
 *
 * Ce fichier fait partie du projet Egnimaxion.
 * Toute reproduction, distribution, modification ou utilisation
 * non autorisée de ce code est strictement interdite.
 */
/**
 * @return PDO|void
 */
function conexionbdd()
{

    require __DIR__ . '/../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_NAME'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];
    try {

        $bdd = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        return $bdd;
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>