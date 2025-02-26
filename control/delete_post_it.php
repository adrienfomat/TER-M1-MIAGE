<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require_once __DIR__ . '/../model/db_connexion.php'; // Connexion à la base de données
    require_once __DIR__ . '/fonction.php'; // Appel des fonctions


    if (isset($_GET['idPostIt']) && isset($_SESSION['idUser'])) {
        $idPostIt = $_GET['idPostIt'];
        $idUser = $_SESSION['idUser'];
        $db_connexion = connexion();

        // Je verifie si le post-it appartient bien à l'utilisateur qui veit le supprimer
        $requete_Verif = "SELECT * FROM `post-it` WHERE idPostIt = ? AND idUser = ?";
        $statement = $db_connexion->prepare($requete_Verif);
        $statement->execute([$idPostIt, $idUser]);

        if ($statement->rowCount() > 0) {
            // on supprime le post-it
            $requete_Delete = "DELETE FROM `post-it` WHERE idPostIt = ?";
            $statement = $db_connexion->prepare($requete_Delete);
            if ($statement->execute([$idPostIt])) {
                header('Location: /TER_MIAGE/view/home_post_it_view.php?id=' . $idUser);
                exit();
            } else {
                echo "Erreur lors de la suppression du post-it.";
            }
        } else {
            echo "Post-it non trouvé ou droit non autorisé.";
        }
    } else {
        echo "Données manquantes.";
    }
?>