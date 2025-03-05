<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../control/fonction.php'; // Appel des fonctions
require_once __DIR__ . '/../model/db_connexion.php'; // Appel de la connexion à la base de données

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire de création de post-it
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));
    $color = htmlspecialchars(trim($_POST['color']));
    $idUser = $_SESSION['idUser'];
    $selectedUsers = isset($_POST['selectedUsers']) ? explode(',', $_POST['selectedUsers']) : []; // Récupération des utilisateurs sélectionnés
    

    // changement de la couleur noir car cela ne s'affiche pas avec un ecrire en noir sur fond noir / on ne peut donc pas refaire tout un scrip pour ca . je vais juste changer la couleur par defaut en bleu
    if($color == "#000000") {
        $color = "#0000FF";
    }

    var_dump($color);

    // Vérification côté serveur 
    if(!empty($title) && !empty($content) && strlen($title) <= 15 && strlen($content) <= 150) {
            // Connexion à la base de données
            $db_connexion = connexion();
            var_dump($title);

            

            // Génération de l'identifiant post-it
            $idPostIt = genererIdPostIt($db_connexion);
    
            // Préparation de la requête d'insertion des données
            $requete_Insert = "INSERT INTO `post-it` (idPostIt, titrePostIt, contenuPostIt, datecreatePostIt, datemodificationPostIt, couleur, idUser) 
                                VALUES (?, ?, ?, NOW(), NOW(), ?, ?)";
            $statement = $db_connexion->prepare($requete_Insert);
    
            // Exécution de la requête préparée avec les données
            $statement->execute([$idPostIt, $title, $content, $color, $idUser]);
    
            // Vérification de l'insertion
            if($statement->rowCount() > 0 ) {
                //var_dump($selectedUsers);
                 // Insertion des post it  partagés
                    foreach ($selectedUsers as $username) {
                    $requete = "SELECT idUser FROM user WHERE pseudoUser = ?";
                    $statement = $db_connexion->prepare($requete);
                    $statement->execute([$username]);
                    $user = $statement->fetch(PDO::FETCH_ASSOC);
                    if ($user) {
                        var_dump($user);
                        $idSharedPostIt = genererIdSharedPostIt($db_connexion); // Génération de l'identifiant de post-it partagé
                        $requete = "INSERT INTO `post-it-partager` (idPostItShare, idPostIt, idUser, datePartage) VALUES (?, ?, ?, NOW())";
                        $statement = $db_connexion->prepare($requete);
                        $statement->execute([$idSharedPostIt, $idPostIt, $user['idUser']]);
                    }
                }
                // Redirection vers la page d'accueil
                header('Location: /TER_MIAGE/view/home_post_it_view.php?id=' . $idUser);
            } else {
                // Stocker un message d'erreur si l'insertion a échoué
                $_SESSION['errors']['insert'] = "Erreur lors de l'insertion du post-it.";
                header('Location: /TER_MIAGE/view/create_post_it_view.php?id=' . $idUser);
            }
    }elseif ( strlen($title) > 15 || strlen($content) > 150) {
        $_SESSION['errors']['verification'] = "Erreur : Le titre et le contenu doivent être inférieurs à 15 et 150 caractères respectivement.";
        header('Location: /TER_MIAGE/view/create_post_it_view.php?id=' . $idUser);
        exit();
    }else if (empty($title) || empty($content)) {
        $_SESSION['errors']['verification'] = "Erreur : Un ou plusieurs champs sont vides.";
        header('Location: /TER_MIAGE/view/create_post_it_view.php?id=' . $idUser);
        exit();
    }
}

?>