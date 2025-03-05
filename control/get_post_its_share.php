<?php 
session_start();
require_once __DIR__ . '/../model/db_connexion.php'; // Connexion à la base de données
require_once __DIR__ . '/fonction.php'; // Appel des fonctions

if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];
    $db_connexion = connexion();

    // Récupération des post-its partagés avec l'utilisateur
    $sharedPostIts = getSharedPostIts($idUser, $db_connexion);
    $_SESSION['postItshared'] = $sharedPostIts; // Je stocke les post-it partager  dans la session pour pouvoir les afficher dans la vue lorsque je clique sur view post-it
    

    foreach ($sharedPostIts as $postIt) {
        echo '<div class="post-it2" style="background-color: ' . htmlspecialchars($postIt['couleur']) . '">';
        echo '<h3>' . htmlspecialchars($postIt['idPostIt']) . '</h3>';
        echo '<p>' . htmlspecialchars($postIt['titrePostIt']) . '</p>';
        echo '<div class="icon">';
        echo '<a href="/TER_MIAGE/view/view_post_it_shared.php?idPostIt=' . htmlspecialchars($postIt['idPostIt']) . '&id=' . $_SESSION['idUser'] . '" title="Visualiser"><i class="fa-regular fa-eye"></i></a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'Pas de post it partage avec vous.';
}
?>