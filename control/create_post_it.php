<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../control/fonction.php'; // Appel des fonctions
require_once __DIR__ . '/../model/db_connexion.php'; // Appel de la connexion à la base de données

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));
    $color = htmlspecialchars(trim($_POST['color']));
    $idUser = $_SESSION['idUser'];

    // changement de la couleur noir car cela ne s'affiche pas avec un ecrire en noir sur fond noir / on ne peut donc pas refaire tout un scrip pour ca . je vais juste changer la couleur par defaut en bleu
    if($color == "#000000") {
        $color = "#0000FF";
    }

    // Vérification côté serveur 
    if(!empty($title) && !empty($content) && !empty($color)) {
            // Connexion à la base de données
            $db_connexion = connexion();

            // Génération de l'identifiant post-it
            $idPostIt = genererIdPostIt($db_connexion);
    
            // Préparation de la requête d'insertion des données
            $requete_Insert = "INSERT INTO `post-it` (idPostIt, titrePostIt, contenuPostIt, datecreatePostIt, datemodificationPostIt, couleur, idUser) 
                                VALUES (?, ?, ?, NOW(), NOW(), ?, ?)";
            $statement = $db_connexion->prepare($requete_Insert);
    
            // Exécution de la requête préparée avec les données
            $statement->execute([$idPostIt, $title, $content, $color, $idUser]);
    
            // Vérification de l'insertion
            if($statement->rowCount() > 0) {
                
                // Redirection vers la page d'accueil
                header('Location: /TER_MIAGE/view/home_post_it_view.php?id=' . $idUser);
            } else {
                header('Location: /TER_MIAGE/view/create_post_it_view.php?id=' . $idUser);
            }
    } else {
        $_SESSION['errors']['verification'] = "Erreur : Un ou plusieurs champs sont vides.";
        header('Location: /TER_MIAGE/view/create_post_it_view.php?id=' . $idUser);
        exit();
    }
}

?>