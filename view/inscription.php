<?php
session_start(); // Démarrage de la session
header('Content-Type: application/json'); // Type de contenu JSON
/* Affichage des erreurs */
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

require_once __DIR__ . '/../control/fonction.php'; // Appel des fonctions
require_once __DIR__ . '/../model/db_connexion.php'; // Appel de la connexion à la base de données

$response = ['success' => false, 'errors' => []]; // Initialisation de la réponse

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $date_naissance = htmlspecialchars($_POST['date_de_naissance']);

    /* Vérification côté serveur : s je javascript est désactivé on force le maintien sur la page inscritption en cas de champ vidde */
    if (empty($nom) || empty($prenom) || empty($pseudo) || empty($password) || empty($email) || empty($date_naissance)) {
        $_SESSION['errors']['verification'] = "Erreur : Un ou plusieurs champs sont vides.";
        //header('Location: /TER_MIAGE/view/inscription_view.php');
        //exit();
    }else{
            // Hachage du mot de passe
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Connexion à la base de données
        $db_connexion = connexion();

        // Génération de l'identifiant utilisateur
        $iduser = genererIdUtilisateur($db_connexion);

        // Chemin de l'image en dur (à modifier)
        $image_path = '/TER_MIAGE/model/image/image1.jpg';

        // je verifie si l'email existe deja dans la base de donnees 
        $requete_email = "SELECT idUser FROM user WHERE  mailuser= ?";
        $statement = $db_connexion->prepare($requete_email);
        $statement->execute([$email]);
        $response1 = $statement->fetch(); // je recupere l'utilisateur

        // je verifie si le pseudo existe deja dans la base de donnees
        $requete_pseudo = "SELECT idUser FROM user WHERE  pseudoUser= ?";
        $statement = $db_connexion->prepare($requete_pseudo);
        $statement->execute([$pseudo]);
        $response2 = $statement->fetch(); // je recupere le pseudo
        
        /* si l'email et le pseudo n'existe pas dans la base de donnees alors je peux inscrire l'utilisateur */
        if(!$response1 && !$response2){
            // Préparation de la requête d'insertion des données
            $requete_Insert = "INSERT INTO user (idUser, nomUser, prenomUser, pseudoUser, mailUser, datenaissanceUser, dateinscriptionUser, image, passwordUser) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?)";
            $statement = $db_connexion->prepare($requete_Insert);

            // Exécution de la requête préparée avec les données
            $valeurs = [$iduser, $nom, $prenom, $pseudo, $email, $date_naissance, $image_path, $password];
            $resultat = $statement->execute($valeurs);

        }else if($response1){
            // je met un message d'erreur si l'email existe déja dans  une session pour pouvoir l'afficher dans la page inscription_view
            $_SESSION['errors']['email'] = "Cet email est déjà utilisé.";
            //header('Location: /TER_MIAGE/view/inscription_view.php');
            //exit();

        }else if($response2){
            // je met un message d'erreur si le pseudo existe déja dans une session pour pouvoir l'afficher dans la page inscription_view
            $_SESSION['errors']['pseudo'] = "Ce pseudo est déjà utilisé.";
            //header('Location: /TER_MIAGE/view/inscription_view.php');
            //exit();
        }
            

        // Redirection vers la page de connexion en cas de succès
        if (!headers_sent()) {
            //header('Location: /TER_MIAGE/view/connexion_view.php'); // Redirection serveur  en cas de succès si pas de redirection préalable cote javascript
            //exit();
        } else {
           //echo "<script>window.location.href = '/TER_MIAGE/view/connexion_view.php';</script>"; // Redirection alternative en cas d'erreur de header
            //exit();
        }
    }

    
} else {
    $_SESSION['errors']['general'] = "Aucune donnée reçue.";
    header('Location: /TER_MIAGE/view/inscription_view.php');
    exit();
}
?>