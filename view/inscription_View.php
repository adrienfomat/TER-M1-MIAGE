<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>Formulaire d'inscription</h2>
    <form action="/TER_MIAGE/control/inscription.php" method="POST">
        <!-- Champ Nom -->
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <!-- Champ Prénom -->
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <!-- Champ Pseudo -->
        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required>

        <!-- Champ Mot de passe -->
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <!-- Champ Email -->
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <!-- Champ Date de naissance -->
        <label for="date_naissance">Date de naissance :</label>
        <input type="date" id="date_naissance" name="date_naissance" required>

        <!-- Bouton de soumission -->
        <input type="submit" value="S'inscrire">
    </form>

</body>
</html>