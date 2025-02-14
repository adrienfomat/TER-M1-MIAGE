<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/TER_MIAGE/view/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="login-page">
    <div class="row-page">
        <!-- Colonne Image -->
        <div class="login-col">
            <img src="/TER_MIAGE/model/image/image1.jpg" alt="Image de connexion"> 
        </div>

        <!-- Formulaire de connexion -->
        <div class="login-col-input">
            <h1>Connexion</h1>
            <h3>Accédez à votre compte</h3>
            <form id="loginForm" action="/TER_MIAGE/control/connexion.php" method="POST">
                <?php if (isset($_SESSION['errors']['general'])): ?>
                    <p class='error'><?= htmlspecialchars($_SESSION['errors']['general']) ?></p>
                <?php endif; ?>
                <label for="email">e-mail</label>
                <input type="email" id="email" name="email" placeholder="Entrez votre e-mail">
                <?php if (isset($_SESSION['errors']['email'])): ?>
                    <p class='error'><?= htmlspecialchars($_SESSION['errors']['email']) ?></p>
                <?php endif; ?>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe">
                <?php if (isset($_SESSION['errors']['password'])): ?>
                    <p class='error'><?= htmlspecialchars($_SESSION['errors']['password']) ?></p>
                <?php endif; ?>

                <button type="submit" class="login-btn">Se connecter</button>
            </form>

            <h4>Vous n'avez pas de compte ? 
                <a href="/TER_MIAGE/view/inscription_view.php">Inscrivez-vous ici</a>
            </h4>
        </div>
    </div>

    <script src=""></script>
</body>
</html>
<?php
unset($_SESSION['errors']); // je supprime les erreurs de la session après les avoir affichées
?>