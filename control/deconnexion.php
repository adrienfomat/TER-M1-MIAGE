<?php 
/*  Ici nous allons faire le fontion deconnexion */
session_start(); // Démarrage de la session
session_destroy(); // Destruction de la session
header('Location: /TER_MIAGE/view/connexion_view.php'); // Redirection vers la page de connexion
exit();

?>