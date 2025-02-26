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
            echo '<a href="/TER_MIAGE/view/inscription_view.php"><i class="fa-regular fa-eye"></i></a>';
            echo '<i class="fa-solid fa-trash"></i>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo 'Utilisateur non connecté.';
    }
?>