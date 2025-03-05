<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérification si l'ID existe dans la session , si non deconnexion
if (!isset($_SESSION['idUser'])) {
    header('Location: /TER_MIAGE/control/deconnexion.php');
    exit();
}


require_once __DIR__ . '/../model/db_connexion.php';
$db_connexion = connexion();

// Récupération des informations de l'utilisateur
$requete = "SELECT nomUser, prenomUser, pseudoUser, mailUser, datenaissanceUser FROM user WHERE idUser = ?";
$statement = $db_connexion->prepare($requete);
$statement->execute([$_SESSION['idUser']]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

// Si aucun utilisateur trouvé, redirection
if (!$user) {
    header('Location: /TER_MIAGE/control/deconnexion.php');
    exit();
}
?>



<html>
<head>
<title>Edit profile</title>
<link rel="stylesheet" href="/TER_MIAGE/view/css/styleprofil_mang.css">

	
</head>



        

        <body>
            
        
    
        
            













            <div class="profile">
            <div >
                <div class="card-header">Profile Picture</div>
                <div class="image">
                    
                    <img class="img-account-profile" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVXkTbByzEOg2Mc68T4J9IRQjMMCxxejdTYg&s" alt="">
                   
                    <label for="image">Changer image de profil</label>
<input class="uploadimg" name="image" id="image" type="file">
                </div>



                <div class="card-header">Détails du votre compte</div>
                <div class="card-body">

                     <form method="POST" action="../control/update_profile.php" enctype="multipart/form-data"> 
                     <label for="nomUser">Nom</label>
<input class="form-control" type="text" name="nom" id="nomUser" value="<?php echo htmlspecialchars($user['nomUser']); ?>">

<label for="prenomUser">Prénom</label>
<input class="form-control" type="text" name="prenom" id="prenomUser" value="<?php echo htmlspecialchars($user['prenomUser']); ?>">

<label for="pseudoUser">Pseudo</label>
<input class="form-control" type="text" name="pseudo" id="pseudoUser" value="<?php echo htmlspecialchars($user['pseudoUser']); ?>">

<label for="mailUser">Email</label>
<input class="form-control" type="email" name="email" id="mailUser" value="<?php echo htmlspecialchars($user['mailUser']); ?>">

<label for="datenaissanceUser">Date de naissance</label>
<input class="form-control" type="text" name="date_de_naissance" id="datenaissanceUser" value="<?php echo htmlspecialchars($user['datenaissanceUser']); ?>">

                <label for="passwordUser">Changer Password</label>
                <input class="form-control" type="password" name="passwordUser" id="passwordUser" placeholder="*************">
                </div>
                <button class="save-btn" type="submit">Enregistrer les changements</button>
            </form>
                


            </div>
</body>
        
 

</html>