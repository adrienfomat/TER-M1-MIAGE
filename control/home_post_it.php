<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* Ici on va recuperer les post it de chaque utilisateur et ses post-it partager */

require_once __DIR__ . '/fonction.php'; // Appel des fonctions
require_once __DIR__ . '/../model/db_connexion.php'; // Appel de la connexion à la base de données


?>