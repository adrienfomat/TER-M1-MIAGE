<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* Ici on vérifie si l'id du navigateur est le même que celui dans la session sinon déconnexion */
if ((isset($_GET['id']) && $_GET['id'] != $_SESSION['idUser']) || !isset($_GET['id']) || empty($_GET['id'])) {
    session_destroy();
    header('Location: /TER_MIAGE/control/deconnexion.php');
    exit();
} else {
    $_SESSION['idUser'] = $_GET['id']; // Je récupère l'id de l'utilisateur connecté et je le mets dans la session
}

require_once __DIR__ . '/../control/fonction.php'; // Appel des fonctions
$db_connexion = connexion();

// Récupération de tous les utilisateurs de la base de données pour le partage
$requete = "SELECT pseudoUser FROM user WHERE idUser != ?"; // On exclut l'utilisateur connecté de la liste des utilisateurs
$statement = $db_connexion->prepare($requete);
$statement->execute([$_SESSION['idUser']]);
$users = $statement->fetchAll(PDO::FETCH_ASSOC); // On récupère les utilisateurs sous forme de tableau associatif

$postItId = $_GET['idPostIt'] ?? null; // Je récupère l'id du post-it dans l'url
$postIt = null;

if ($postItId && isset($_SESSION['postIt'])) {
    foreach ($_SESSION['postIt'] as $p) {
        if ($p['idPostIt'] === $postItId) {
            $postIt = $p;
            $_SESSION['sharedUsers'] = getSharedUsers($postItId, $db_connexion); // Je récupère les utilisateurs avec lesquels le post-it est partagé
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/TER_MIAGE/view/css/style_create_post_it.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Modifier un post-it</title>
</head>
<body>
    
    <div class="left-btn"></div> 
<!-- Formulaire de modification de post-it start -->
    <form action="/TER_MIAGE/control/update_post_it.php" method="POST">
        <div class="main-box">
            <div class="box">
                <?php if (isset($_SESSION['errors']['verification'])): ?>
                    <p class='error'><?= htmlspecialchars($_SESSION['errors']['verification']) ?></p>
                <?php endif; ?>
                <div class="titre">
                    <label for="title" class="titre1">Titre</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($postIt['titrePostIt'] ?? '') ?>" required>
                </div>
                <div class="contenu">
                    <label for="content" class="titre2">Contenu</label>
                    <textarea name="content" id="content" cols="80" rows="10" style="resize: none;" required><?= htmlspecialchars($postIt['contenuPostIt'] ?? '') ?></textarea>
                </div>
                <div class="sharedwith">
                    <p>Partager avec :</p>
                    <input type="text" placeholder="Rechercher..." id="search" name="search">
                    <div id="userList" class="user-list">
                        <?php foreach ($users as $user): ?>
                            <div class="user-item" data-username="<?= htmlspecialchars($user['pseudoUser']) ?>">
                                <?= htmlspecialchars($user['pseudoUser']) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="people" id="selectedUsers">
                    <!-- Les utilisateurs sélectionnés seront affichés ici pour que l'utilisateur sache déjà qui il a sélectionné -->
                    <?php if (isset($_SESSION['sharedUsers'])): ?>
                        <?php foreach ($_SESSION['sharedUsers'] as $sharedUser): ?>
                            <div class="user-item" data-username="<?= htmlspecialchars($sharedUser) ?>">
                                <?= htmlspecialchars($sharedUser) ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <input type="hidden" name="selectedUsers" id="selectedUsersInput" value="<?= htmlspecialchars(implode(',', $_SESSION['sharedUsers'] ?? [])) ?>">
                <div class="bottompostit">
                    <button type="submit" class="save-button">SAVE</button>
                    <div class="color-palette">
                        <div class="form-group">
                            <label for="color">Couleur</label>
                            <input type="color" name="color" id="color" class="form-control" value="<?= htmlspecialchars($postIt['couleur'] ?? '#ffffff') ?>" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Script pour la recherche d'utilisateurs et la sélection starts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/TER_MIAGE/control/scripts/create_post_it_jquery.js"></script>
    <!-- Script pour la recherche d'utilisateurs et la sélection ends -->
</body>
</html>