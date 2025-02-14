<?php 
      /* Ici nous allons faire la fonction de suppression de compte */
        session_start(); // Démarrage de la session
        require_once __DIR__ . '/../model/db_connexion.php'; // Appel de la connexion à la base de données

        // je recupere l'id de l'utilisateur dans la session
        $idUser = $_SESSION['idUser'];

        // Connexion à la base de données
        $db_connexion = connexion();

        // Requête pour supprimer l'utilisateur
        $requete_delete = "DELETE FROM user WHERE idUser = ?";
        $statement = $db_connexion->prepare($requete_delete);
        $statement->execute([$idUser]);

        // Destruction de la session
        session_destroy();

        // Redirection vers la page de connexion
        header('Location: /TER_MIAGE/view/connexion_view.php');
        exit();

?>