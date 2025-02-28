<?php 
session_start();
require_once __DIR__ . '/../model/db_connexion.php'; // Connexion à la base de données
require_once __DIR__ . '/fonction.php'; // Appel des fonctions

if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];
    $db_connexion = connexion();

    // Récupération des post-its partagés avec l'utilisateur
    $sharedPostIts = getSharedPostIts($idUser, $db_connexion);

    foreach ($sharedPostIts as $postIt) {
        echo '<div class="post-it2" style="background-color: ' . htmlspecialchars($postIt['couleur']) . '">';
        echo '<h3>' . htmlspecialchars($postIt['titrePostIt']) . '</h3>';
        echo '<p>' . htmlspecialchars($postIt['contenuPostIt']) . '</p>';
        echo '<div class="icon">';
        echo '<a href="/TER_MIAGE/view/connexion_view.php"><i class="fa-regular fa-eye"></i></a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'Pas de post it partage avec vous.';
}
?>