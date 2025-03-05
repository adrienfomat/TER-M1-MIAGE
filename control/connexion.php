<?php
session_start(); // Démarrage de la session

require_once __DIR__ . '/fonction.php'; // Appel des fonctions
require_once __DIR__ . '/../model/db_connexion.php'; // Appel de la connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $login = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

      // Stocker les valeurs saisies dans la session
        $_SESSION['user']['email'] = $login;
        $_SESSION['user']['password'] = $password;

    if (!empty($login) && !empty($password)) {
        // Connexion à la base de données
        $db_connexion = connexion();

        // Requête pour récupérer les informations de l'utilisateur
        $requete_login = "SELECT idUser, prenomUser, passwordUser FROM user WHERE mailuser = ?";
        $statement = $db_connexion->prepare($requete_login);
        $statement->execute([$login]);
        $user = $statement->fetch();

        // Vérification si l'utilisateur existe
        if ($user) {
            // Vérification du mot de passe
            if (password_verify($password, $user['passwordUser'])) {
                // Stocker l'id et le prénom de l'utilisateur dans une session
                $_SESSION['idUser'] = $user['idUser'];
                $_SESSION['prenomUser'] = $user['prenomUser'];

                //On recupere les post-it de l'utilisateur
           //$_SESSION['postIt'] = getPostIts($user['idUser'], $db_connexion);     

                // Redirection vers la page d'accueil
                header('Location: /TER_MIAGE/view/home_post_it_view.php?id=' . $user['idUser']);
                exit();
            } else {
                // Stocker un message d'erreur si le mot de passe est incorrect
                $_SESSION['errors']['password'] = "Mot de passe incorrect.";
            }
        } else {
            // Stocker un message d'erreur si l'email n'existe pas dans la base de données
            $_SESSION['errors']['email'] = "Cet utilisateur n'existe pas.";
        }
    } else {
        // Stocker un message d'erreur si les champs sont vides
        $_SESSION['errors']['general'] = "Veuillez remplir tous les champs.";
    }

    // Redirection vers la page de connexion avec les erreurs
    header('Location: /TER_MIAGE/view/connexion_view.php');
    exit();
} else {
   // echo "<p>Aucune donnée reçue.</p>";
}
?>