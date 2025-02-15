
<?php 
        if(session_status() == PHP_SESSION_NONE) {
                session_start();
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
    
    

    <div class="colonne-gauche">
    <nav>
        <ul>
        <a href="create_post_it_view.php?id=<?php echo $_SESSION['idUser']; ?>" title="Créer un nouveau post-it">
    <i class="fa-solid fa-circle-plus"></i>
    </a>
           
        </ul>
    </nav>
    <div class="section">
    <h4>Mes Post-its</h4>
    
    </div>
        <div class="post-it">
            <?php 
                if(isset($_SESSION['postIt'])):
                    foreach ($_SESSION['postIt'] as $postIt):
                        
                    
            ?>
            <div class="post-it1">
                <h3><?= htmlspecialchars($postIt['idPostIt']) ?></h3>
                <p><?= htmlspecialchars($postIt['titrePostIt']) ?></p>
            </div>
            <?php 
            endforeach;
            endif;
            ?>
            <div class="post-it1 test">
                <h3>Post-it 2</h3>
                <p>Contenu du post-it 1</p>
            </div>
            <div class="post-it1 test2">
                <h3>Post-it 3</h3>
                <p>Contenu du post-it 1</p>
            </div>
            <div class="post-it1">
                <h3>Post-it 4</h3>
                <p>Contenu du post-it 1</p>
            </div>
        </div>
        
    </div>

   
    <div class="separateur"></div>

    
    <div class="colonne-droite">
    <div class="section">
    <h4>Post-it partagés</h4>
    </div>
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
    
    
    <!-- Ici onnverifie si l'id du navigateur est le meme que celui dans la session sinon deconnexxion-->
    <?php
        if ( isset($_GET['id']) && $_GET['id'] != $_SESSION['idUser']) {
            session_destroy();
            header('Location: /TER_MIAGE/control/deconnexion.php');
            exit();
        }
    ?>
    

<script src="script.js"></script>
</body>
</html>