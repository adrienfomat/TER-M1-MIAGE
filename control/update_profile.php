<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../model/db_connexion.php';

$response = ['success' => false, 'errors' => []];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $date_naissance = htmlspecialchars($_POST['date_de_naissance']);
    $idUser = $_SESSION['idUser'];

    $db_connexion = connexion();
    $image_path = null;
    
    /*echo '<pre>';
    print_r($_POST);
    print_r($_FILES);
    echo '</pre>';
    exit(); */
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) { //si l'image qui vient de profil_management existe dans FILES (a été bien téléchargé) et si pas d'erreur :
        $file_tmp = $_FILES['image']['tmp_name']; //sauvegarde temporaire de l'image
        $file_name = basename($_FILES['image']['name']); //récupére le nom de l'image (sans chemin absolu)
        $file_size = $_FILES['image']['size']; //image size
        $file_type = mime_content_type($file_tmp); //type image
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    
        // Valider file type et size
        if (in_array($file_type, $allowed_types) && $file_size <= 5 * 1024 * 1024) { // Limite 5MB
            // Define the upload directory and generate the new file path
            $upload_dir = __DIR__ . '/../uploads/'; 
            $new_image_path = $upload_dir . uniqid('profile_') . '.' . pathinfo($file_name, PATHINFO_EXTENSION); //on génére le nom de l'image: un id unique + extension (.png .gif...)
            if (!is_writable($upload_dir)) {
                error_log("Upload directory is not writable: " . $upload_dir);
            }
            if (!file_exists($file_tmp)) {
                error_log("Temporary file does not exist: " . $file_tmp);
            }
            if (move_uploaded_file($file_tmp, $new_image_path)) { //Déplace le fichier depuis son emplacement temporaire vers son emplacement final
                $image_path = '/TER_MIAGE/uploads/' . basename($new_image_path); // le lien publique qu'on va stocker dans la BD
            } else {
                $_SESSION['errors']['image'] = "Erreur lors de l'upload de l'image.";
                header('Location: /TER_MIAGE/view/profil_management.php');
                exit();
            }
        } else {
            $_SESSION['errors']['image'] = "Type ou taille de fichier invalide.";
            header('Location: /TER_MIAGE/view/profil_management.php');
            exit();
        }
    }

    // Vérification si l'email ou le pseudo existent déjà pour un autre utilisateur
    $requete_email = "SELECT idUser FROM user WHERE mailUser = ? AND idUser != ?"; //idUser != ? pour exclure l'utilisateur actuel
    $statement = $db_connexion->prepare($requete_email);
    $statement->execute([$email, $idUser]);
    $response1 = $statement->fetch();

    $requete_pseudo = "SELECT idUser FROM user WHERE pseudoUser = ? AND idUser != ?";
    $statement = $db_connexion->prepare($requete_pseudo);
    $statement->execute([$pseudo, $idUser]);
    $response2 = $statement->fetch();

    if ($response1) {
        $_SESSION['errors']['email'] = "Cet email est déjà utilisé.";
        header('Location: /TER_MIAGE/view/profil_management.php');
        exit();
    }
    if ($response2) {
        $_SESSION['errors']['pseudo'] = "Ce pseudo est déjà utilisé.";
        header('Location: /TER_MIAGE/view/profil_management.php');
        exit();
    }

    // Mise à jour avec ou sans mot de passe
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $requete_Update = "UPDATE user SET nomUser = ?, prenomUser = ?, pseudoUser = ?, mailUser = ?, datenaissanceUser = ?, image = ?, passwordUser = ? WHERE idUser = ?";
        $valeurs = [$nom, $prenom, $pseudo, $email, $date_naissance, $image_path, $password, $idUser];
    } else {
        $requete_Update = "UPDATE user SET nomUser = ?, prenomUser = ?, pseudoUser = ?, mailUser = ?, datenaissanceUser = ?, image = ? WHERE idUser = ?";
        $valeurs = [$nom, $prenom, $pseudo, $email, $date_naissance, $image_path, $idUser];
    }

    $statement = $db_connexion->prepare($requete_Update);
    $resultat = $statement->execute($valeurs);

    if ($resultat) {
        $_SESSION['success'] = "Modification réussie.";
    } else {
        $_SESSION['errors']['general'] = "Erreur lors de la modification.";
    }

    header('Location: /TER_MIAGE/view/profil_management.php');
    exit();
} else {
    $_SESSION['errors']['general'] = "Aucune donnée reçue.";
    header('Location: /TER_MIAGE/view/profil_management.php');
    exit();
}
?>
