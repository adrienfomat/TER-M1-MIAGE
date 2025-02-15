<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* Ici on va recuperer les post it de chaque utilisateur et ses post-it partager */

require_once __DIR__ . '/fonction.php'; // Appel des fonctions
require_once __DIR__ . '/../model/db_connexion.php'; // Appel de la connexion à la base de données

// Connexion à la base de données
$db_connexion = connexion();

// Récupération de l'id de l'utilisateur
$idUser = $_SESSION['idUser'];

/* Récupération des post-it de l'utilisateur */
$requete_Select = "SELECT idPostIt,titrePostIt,contenuPostIt,couleur FROM `post-it` WHERE idUser = ?";
$statement = $db_connexion->prepare($requete_Select);
$statement->execute([$idUser]);
$postIt = $statement->fetchAll();

//mise des informations du post-it  dans la session
$_SESSION['postIt'] = $postIt;
var_dump($_SESSION['postIt']);





                                                                                                                          
?>