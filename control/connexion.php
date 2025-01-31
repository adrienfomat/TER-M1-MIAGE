<?php 
    session_start(); // Démarrage de la session

// je verifie les informations de connexion

require_once __DIR__ . '/fonction.php'; // Appel des fonctions
require_once __DIR__ . '/../model/db_connexion.php'; // Appel de la connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);

    // Connexion à la base de données
    $db_connexion = connexion();

    // Requête pour récupérer les informations de l'utilisateur
    $requete_login = "SELECT * FROM user WHERE  mailuser= ?";
    $statement = $db_connexion->prepare($requete_login);
    $statement->execute([$login]);
    $user = $statement->fetch();

    // Si l'utilisateur existe
    if ($user) {
        // Vérification du mot de passe
        if (password_verify($password, $user['passwordUser'])) {
            $_SESSION['id'] = $user;
            // Redirection vers la page d'accueil
            header('Location: /TER_MIAGE/view/potit_view.php');
            exit();
        } else {
            echo "<p>Mot de passe incorrect.</p>";
        }
    } else {
        echo "<p>Utilisateur non trouvé.</p>";
    }
} else {
    echo "<p>Aucune donnée reçue.</p>";
}

?>