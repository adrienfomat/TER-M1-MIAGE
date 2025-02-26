<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/*Ici onnverifie si l'id du navigateur est le meme que celui dans la session sinon deconnexxion*/
if ( isset($_GET['id']) && $_GET['id'] != $_SESSION['idUser']) {
    session_destroy();
    header('Location: /TER_MIAGE/control/deconnexion.php');
    exit();
}else{
    $_SESSION['idUser'] = $_GET['id']; //je recupere l'id de l'utilisateur connecter et je le met dans la session
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylecreatepost.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>create post it</title>
    
</head>
<body>
    
    

    
    <div class="left-bar"></div>
   <div class="left-btn">
   </div> 
    
    
<form action="/TER_MIAGE/control/create_post_it.php" method="POST">
    <div class="main-box">
        <div class="box">
        <?php if (isset($_SESSION['errors']['verification'])): ?>
                    <p class='error'><?= htmlspecialchars($_SESSION['errors']['verification']) ?></p>
        <?php endif; ?>
            <div class="titre">
            <label for="title" class="titre1">Titre</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="contenu">
                    <label for="content" class="titre2">Contenu</label>
                    <textarea name="content" id="content" cols="80" rows="10" style="resize: none;"></textarea>
            </div>
            <div class="sharedwith">
                <p>Partager avec :</p>
                <input type="text" placeholder="Rechercher..." name="search">
            </div>
            <div class="people">
                <label for="sharedwith" class="user">none
                    <span class="delete-icon">&times;</span>
                </label>
                <label for="sharedwith" class="user"> none
                    <span class="delete-icon">&times;</span>
                </label>
                <label for="sharedwith" class="user">none
                    <span class="delete-icon">&times;</span>
                </label>
            </div>
            <div class="bottompostit">
                <button type="submit" class="save-button">SAVE</button>
                <div class="color-palette">
                <div class="form-group">
                <label for="color">Couleur</label>
                <input type="color" name="color" id="color" class="form-control" required>
            </div>
                </div>
            </div>
        </div>
    </div>
</form>
        </div>
        <div class="right-bar"></div>


</body>
</html>