<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/TER_MIAGE/view/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Créer un Post-it</title>
</head>
<body>
    <div class="container">
        <h1>Créer un Post-it</h1>
        <?php if (isset($_SESSION['errors'])): ?>
            <div class="alert alert-danger">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
                <?php unset($_SESSION['errors']); ?>
            </div>
        <?php endif; ?>
        <form action="/TER_MIAGE/control/create_post_it.php" method="POST">
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content">Contenu</label>
                <textarea name="content" id="content" class="form-control" maxlength="150" required></textarea>
            </div>
            <div class="form-group">
                <label for="color">Couleur</label>
                <input type="color" name="color" id="color" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>

    <!-- Ici onnverifie si l'id du navigateur est le meme que celui dans la session sinon deconnexxion-->
    <?php
        if ( isset($_GET['id']) && $_GET['id'] != $_SESSION['idUser']) {
            session_destroy();
            header('Location: /TER_MIAGE/control/deconnexion.php');
            exit();
        }else{
            $_SESSION['idUser'] = $_GET['id']; //je recupere l'id de l'utilisateur connecter et je le met dans la session
        }
    ?>
</body>
</html>