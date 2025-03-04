<?php
session_start();
require_once __DIR__ . '/../model/db_connexion.php'; // Connexion à la base de données
require_once __DIR__ . '/fonction.php'; // Appel des fonctions

if (isset($_GET['idPostIt']) && isset($_SESSION['idUser'])) {
    $idPostIt = $_GET['idPostIt'];
    $idUser = $_SESSION['idUser'];
    $db_connexion = connexion();

    // Récupération du post-it
    $requete = "SELECT * FROM `post-it` WHERE idPostIt = ? AND idUser = ?";
    $statement = $db_connexion->prepare($requete);
    $statement->execute([$idPostIt, $idUser]);
    $postIt = $statement->fetch(PDO::FETCH_ASSOC);

    if ($postIt) {
        $_SESSION['postItview'] = $postIt;
        var_dump($postIt);

        // Récupération des utilisateurs avec lesquels le post-it est partagé
        $requete = "SELECT u.pseudoUser FROM `post-it-partager` p JOIN `user` u ON p.idUser = u.idUser WHERE p.idPostIt = ?";
        $statement = $db_connexion->prepare($requete);
        $statement->execute([$idPostIt]);
        $sharedUsers = $statement->fetchAll(PDO::FETCH_COLUMN);

        $_SESSION['sharedUsers'] = $sharedUsers;
        var_dump($sharedUsers);
    } else {
        $_SESSION['errors']['postIt'] = "Post-it non trouvé ou vous n'avez pas les droits pour le voir.";
    }

    //header('Location: /TER_MIAGE/view/view_post_it.php?id=' . $idUser . '&idPostIt=' . $idPostIt);
    exit();
} else {
    $_SESSION['errors']['postIt'] = "Paramètres manquants.";
    //header('Location: /TER_MIAGE/view/home_post_it_view.php');
    exit();
}
?>