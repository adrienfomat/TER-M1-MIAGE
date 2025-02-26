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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Accueil</title>
</head>

<body>
    <!-- Mes post its start -->
    <div class="colonne-gauche">
        <nav>
            <ul>
                <a href="create_post_it_view.php?id=<?= $_SESSION['idUser']; ?>" title="Créer un nouveau post-it">
                    <i class="fa-solid fa-circle-plus"></i>
                </a>
            </ul>
        </nav>
        <div class="section">
            <h4>Mes Post-its</h4>
        </div>
        <div class="post-it" id="postItList">
            <?php 
            if (isset($_SESSION['postIt']) && !empty($_SESSION['postIt'])):
                foreach ($_SESSION['postIt'] as $postIt):
            ?>
                    <div class="post-it1" style="background-color: <?= htmlspecialchars($postIt['couleur']) ?>">
                        <h3><?= htmlspecialchars($postIt['idPostIt']) ?></h3>
                        <p><?= htmlspecialchars($postIt['titrePostIt']) ?></p>
                        <div class="icon">
                            <a href="/TER_MIAGE/view/inscription_view.php"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="/TER_MIAGE/view/connexion_view.php"><i class="fa-regular fa-eye"></i></a>
                            <a href="/TER_MIAGE/control/delete_post_it.php?idPostIt=<?= htmlspecialchars($postIt['idPostIt']) ?>&id=<?= $_SESSION['idUser']; ?>" title="Supprimer"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
            <?php 
                endforeach;
            endif;
            ?>
        </div>
    </div>
<!-- Mes post its end -->

    <div class="separateur"></div>

<!-- Post-it partagés start -->
    <div class="colonne-droite">
        <div class="section">
            <h4>Post-it partagés</h4>
        </div>
        <div class="post-it" id="sharedPostItList">
            <!-- Les post-its partagés seront chargés ici -->
        </div>
<!-- Post-it partagés end -->

<!-- Menu vertical start -->
        <i class="fa-solid fa-grip-vertical" id="menu-icon"></i>
        <div class="menu-vertical" id="vertical-menu">
            <ul>
                <li><i class="fa-solid fa-house"></i><a href="#">Accueil</a></li>
                <li><i class="fa-solid fa-user"></i><a href="#">Modifier profil</a></li>
                <li><i class="fa-solid fa-trash"></i><a href="/TER_MIAGE/control/supprimer_compte.php">Supprimer compte</a></li>
                <li><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="/TER_MIAGE/control/deconnexion.php">Deconnexion</a></li>
            </ul>
        </div>
    </div>
<!-- Menu vertical end -->


<!-- Script pour rafraîchir les post-its toutes les 2 secondes -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function loadPostIts() {
            $('#postItList').load('/TER_MIAGE/control/get_post_its.php');
        }

        $(document).ready(function() {
            loadPostIts();
            setInterval(loadPostIts, 2000); // Rafraîchir toutes les 5 secondes(c'st un peu lourd pour un serveur mais je met 2 pour rapiement tester )

        });
    </script>
<!-- Fin du script -->
</body>
</html>