<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* Ici on vérifie si l'id du navigateur est le même que celui dans la session sinon déconnexion */
if (isset($_GET['id']) && $_GET['id'] != $_SESSION['idUser']) {
    session_destroy();
    header('Location: /TER_MIAGE/control/deconnexion.php');
    exit();
} else {
    $_SESSION['idUser'] = $_GET['id']; // Je récupère l'id de l'utilisateur connecté et je le mets dans la session
}

$postItId = $_GET['idPostIt'] ?? null;
$postIt = null;

if ($postItId && isset($_SESSION['postIt'])) {
    foreach ($_SESSION['postIt'] as $p) {
        if ($p['idPostIt'] === $postItId) {
            $postIt = $p;
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
    <title>View Post-it</title>
</head>
<body>
    <div class="left-btn">
    </div> 

    <form action="/TER_MIAGE/control/create_post_it.php" method="POST">
        <div class="main-box">
            <div class="box">
                <div class="titre">
                <?php
                if ($postIt) {
                ?>
                    <label for="title" class="titre1">Titre</label>
                    <p><?= htmlspecialchars($postIt['titrePostIt']) ?></p>
                </div>
                <div class="contenu">
                    <label for="content" class="titre2">Contenu</label>
                    <p class="titre3"><?= htmlspecialchars($postIt['contenuPostIt']) ?></p>
                <?php
                } else {
                    echo '<p>Post-it non trouvé.</p>';
                }
                ?>

                <?php
                if (isset($_SESSION['sharedUsers']) && !empty($_SESSION['sharedUsers'])) {
                ?>
                <div class="sharedwith">
                    <p>Partager avec :</p>
                </div>
                <div class="people">
                <?php
                    foreach ($_SESSION['sharedUsers'] as $sharedUser) {
                ?>
                    <label for="sharedwith" class="user"><?= htmlspecialchars($sharedUser) ?></label>
                <?php
                    }
                ?>
                </div>
                <?php
                }
                ?>
                <div class="bottompostit">
                    <a href="home_post_it_view.php"><div class="closebt">fermer</div></a>
                    <div class="form-group">
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>