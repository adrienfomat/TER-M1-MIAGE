<?php 
    session_start();
    require_once __DIR__ . '/../model/db_connexion.php'; // Connexion à la base de données
    require_once __DIR__ . '/fonction.php'; // Appel des fonctions

    if (isset($_SESSION['idUser'])) {
        $idUser = $_SESSION['idUser'];
        $db_connexion = connexion();

        // Récupération des post-its de l'utilisateur
        $postIts = getPostIts($idUser, $db_connexion);

        foreach ($postIts as $postIt) {
            echo '<div class="post-it1" style="background-color: ' . htmlspecialchars($postIt['couleur']) . '">';
            echo '<h3>' . htmlspecialchars($postIt['idPostIt']) . '</h3>';
            echo '<p>' . htmlspecialchars($postIt['titrePostIt']) . '</p>';
            echo '<div class="icon">';
            echo '<i class="fa-regular fa-pen-to-square"></i>';
            echo '<a href="/TER_MIAGE/view/connexion_view.php"><i class="fa-regular fa-eye"></i></a>';
            echo '<a href="/TER_MIAGE/control/delete_post_it.php?idPostIt=' . htmlspecialchars($postIt['idPostIt']) . '&id=' . $_SESSION['idUser'] . '" title="Supprimer"><i class="fa-solid fa-trash"></i></a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo 'Utilisateur non connecté.';
    }
?>