<?php
require_once __DIR__ . '/../control/fonction.php'; // Appel des fonctions
require_once __DIR__ . '/../model/db_connexion.php'; // Appel de la connexion à la base de données

/* Ici nous récupérons les données du formulaire d'inscription et nous les affichons */


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $date_naissance = htmlspecialchars($_POST['date_naissance']);

    /*hachaage du mot de passe*/
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Connexion à la base de données
    $db_connexion = connexion();

    // Génération de l'identifiant utilisateur
    $iduser = genererIdUtilisateur($db_connexion);

    //chemin de l'image en dur(a modifier)
    $image_path = '/opt/lampp/htdocs/TER_MIAGE/view/inscription_View.php';

    //préparation de la requete d'insertion des données
    $requeteInsert = "INSERT INTO user (idUser, nomUser, prenomUser, pseudoUser, mailUser,datenaissanceUser,dateinscriptionUser,image,passwordUser) 
            VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?)";
    $statement = $db_connexion->prepare($requeteInsert);


// Exécution de la requête preparer avec les données
$valeurs = [$iduser, $nom, $prenom, $pseudo, $email, $date_naissance, $image_path, $password];

if ($statement->execute($valeurs)) {
    // Redirection vers la page de connexion en cas de succès
    header('Location: /TER_MIAGE/view/connexion_view.php');
    exit();
} else {
    echo "<p>Erreur lors de l'inscription.</p>";
}
} else {
echo "<p>Aucune donnée reçue.</p>";
}
?>