<?php
session_start();
require_once __DIR__ . '/../model/db_connexion.php'; // Connexion à la base de données
require_once __DIR__ . '/fonction.php'; // Appel des fonctions

if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];
    $db_connexion = connexion();

    // Récupération des post-its de l'utilisateur
    $postIts = getPostIts($idUser, $db_connexion);

    echo json_encode(['success' => true, 'postIts' => $postIts]);
} else {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté.']);
}
?>