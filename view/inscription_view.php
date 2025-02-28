<?php session_start(); ?>
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
   <title>Page login/signup</title>
</head>
<body class="login-page">
   <section class="login">
       <div class="row-page">
           <div class="login-col-input signup">
               <form  id="inscriptionForm" action="/TER_MIAGE/control/inscription.php" method="POST">
                   <h1>INSCRIPTION</h1>
                   <?php if (isset($_SESSION['errors']['verification'])): ?>
                    <p class='error'><?= htmlspecialchars($_SESSION['errors']['verification']) ?></p>
                   <?php endif; ?>
                   <label for="nom">Nom</label>
                   <input type="text" name="nom" id="nom">
                   <label for="prenom">Prénom</label>
                   <input type="text" name="prenom" id="prenom">
                   <label for="prenom">Pseudo</label>
                   <input type="text" name="pseudo" id="pseudo">
                   <?php if (isset($_SESSION['errors']['pseudo'])): ?>
                    <p class='error'><?= htmlspecialchars($_SESSION['errors']['pseudo']) ?></p>
                   <?php endif; ?>
                   <label for="email" class="label1">Email</label>
                   <input type="email" name="email" id="email" >
                   <?php if (isset($_SESSION['errors']['email'])): ?>
                    <p class='error'><?= htmlspecialchars($_SESSION['errors']['email']) ?></p>
                  <?php endif; ?>
                   <label for="password">Password</label>
                   <input type="password" name="password" id="password" >
                   <label for="passwordConfirm">Confirm Passsword</label>
                   <input type="password" name="passwordConfirm" id="passwordConfirm" >
                   <input type="text" name="date_de_naissance" id="date_de_naissance" placeholder="AAAA-MM-JJ">

                   <button class="login-btn" type="submit">S'inscrire</button>
                   <h6 class="inscrit">Vous avez déjà un compte? <a href="/TER_MIAGE/view/connexion_view.php">Connectez-vous </a></h6>
               </form>
           </div>
           <div class="login-col">
               <img src="/TER_MIAGE/model/image/image2.jpeg" alt="Illustration avion">
           </div>
       </div>
   </section>
   <script src="/TER_MIAGE/control/scripts/inscription.js"></script>

</body>
</html>

<?php
unset($_SESSION['errors']); // je supprime les erreurs de la session apres les avoir affichees
?>