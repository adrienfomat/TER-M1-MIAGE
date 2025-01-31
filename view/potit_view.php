<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        header {
            background-color: #333;
            color: white;
            padding: 1rem;
        }

        nav {
            background-color: #f4f4f4;
            padding: 1rem;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
        }

        nav a:hover {
            background-color: #333;
            color: white;
            border-radius: 3px;
        }

        main {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .welcome-section {
            text-align: center;
            padding: 40px 0;
        }

        .content-section {
            margin-top: 30px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Nom de votre site</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="connexion.php">Connexion</a></li>
            <li><a href="inscription.php">Inscription</a></li>
            <?php
            session_start();
            if(isset($_SESSION['user_id'])) {
                echo '<li><a href="profil.php">Mon Profil</a></li>';
                echo '<li><a href="deconnexion.php">Déconnexion</a></li>';
            }
            ?>
        </ul>
    </nav>

    <main>
        <section class="welcome-section">
            <h2>Bienvenue sur notre site</h2>
            <p>Découvrez nos services et fonctionnalités</p>
        </section>

        <section class="content-section">
            <h3>À propos</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
               Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
               Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
        </section>

        <section class="content-section">
            <h3>Nos services</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
               Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
               Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Nom de votre site. Tous droits réservés.</p>
    </footer>
</body>
</html>