<?php 
require_once __DIR__ . '/../model/db_connexion.php'; // Appel de la connexion à la base de données

/* Ici nous écrirons toutes les fonctions utilisées et ferons juste un appel pour l'usage */


/* Fonction pour générer un nouvel identifiant utilisateur */

function genererIdUtilisateur($db_connexion) {
    // Requête pour récupérer le dernier identifiant utilisateur

    $sql = "SELECT idUser FROM user ORDER BY idUser DESC LIMIT 1";
    $statement = $db_connexion->query($sql);
    $lastIdUser = $statement->fetchColumn();

    // Si un identifiant existe déjà, on l'incrémente
    if ($lastIdUser) {
        $num = (int)substr($lastIdUser, 2) + 1; 
        $newIdUser = 'US' . str_pad($num, 3, '0', STR_PAD_LEFT); //
    } else {
        // Sinon, on commence avec 'US001'
        $newIdUser = 'US001';
    }

    return $newIdUser;
}

/* Fonction pour générer un nouvel identifiant post-it */

function genererIdPostIt($db_connexion) {
    // Requête pour récupérer le dernier identifiant  de post-it

    $sql = "SELECT idPostIt FROM `post-it` ORDER BY idPostIt DESC LIMIT 1";
    $statement = $db_connexion->query($sql);
    $lastIdPostIt = $statement->fetchColumn();

    // Si un identifiant existe déjà, on l'incrémente
    if ($lastIdPostIt) {
        $num = (int)substr($lastIdPostIt, 6) + 1;
        $newIdPostIt = 'PostIt' . str_pad($num, 3, '0', STR_PAD_LEFT);
    } else {
        // Sinon, on commence avec 'PostIt001'
        $newIdPostIt = 'PostIt001';
    }

    return $newIdPostIt;
}

/*Fontion pour generer un nouvel identifiant de post-it partagé */
function genererIdSharedPostIt($db_connexion) {
    // Requête pour récupérer le dernier identifiant de post-it partagé
    $sql = "SELECT idPostItShare FROM `post-it-partager` ORDER BY idPostItShare DESC LIMIT 1";
    $statement = $db_connexion->query($sql);
    $lastIdSharedPostIt = $statement->fetchColumn();

    // Si un identifiant existe déjà, on l'incrémente
    if ($lastIdSharedPostIt) {
        $num = (int)substr($lastIdSharedPostIt, 10) + 1;
        $newIdSharedPostIt = 'SharedPost' . str_pad($num, 3, '0', STR_PAD_LEFT);
    } else {
        // Sinon, on commence avec 'SharedPost001'
        $newIdSharedPostIt = 'SharedPost001';
    }

    return $newIdSharedPostIt;
}


/*Fonction pour recuperer les post-it de l'utilisateur */

function getPostIts($idUser, $db_connexion) {
    $sql = "SELECT idPostIt, titrePostIt, contenuPostIt, couleur FROM `post-it` WHERE idUser = ?";
    $statement = $db_connexion->prepare($sql);
    $statement->execute([$idUser]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction pour récupérer les post-it partagés avec l'utilisateur */
function getSharedPostIts($idUser, $db_connexion) {
    $sql = "SELECT p.idPostIt, p.titrePostIt, p.contenuPostIt, p.couleur FROM `post-it` p JOIN `post-it-partager` sp ON p.idPostIt = sp.idPostIt WHERE sp.idUser = ?";
    $statement = $db_connexion->prepare($sql);
    $statement->execute([$idUser]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/* Fonction pour recuperer les utilisateurs avec lesquels le post-it est partagé */
function getSharedUsers($idPostIt, $db_connexion) {
    $sql = "SELECT u.pseudoUser FROM `post-it-partager` p JOIN `user` u ON p.idUser = u.idUser WHERE p.idPostIt = ?";
    $statement = $db_connexion->prepare($sql);
    $statement->execute([$idPostIt]);
    return $statement->fetchAll(PDO::FETCH_COLUMN);
}



?>