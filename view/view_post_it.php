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
                <p>Lorem, ipsum dolor.</p>
            </div>
            <div class="contenu">
                    <label for="content" class="titre2">Contenu</label>
                    <p class="titre3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil deserunt voluptas et. Harum, quis aspernatur distinctio magnam deserunt vel doloremque incidunt saepe eum blanditiis voluptatem ab doloribus suscipit aliquam, tenetur cupiditate odit quibusdam architecto totam nihil. Alias nam rem earum sit debitis obcaecati, quae tempore, itaque expedita fuga labore et provident pariatur a velit repudiandae delectus, illum ex officia in? Maiores asperiores veniam nemo facilis illo architecto fuga qui natus, sequi velit numquam et quos ducimus vel ipsa, aliquam obcaecati itaque. Facilis ipsum cupiditate harum, temporibus vel officia nisi quaerat reprehenderit explicabo mollitia at! Laudantium blanditiis, excepturi incidunt necessitatibus voluptatum saepe. Dolorem earum, iusto recusandae vitae odio quibusdam at incidunt repellat provident doloribus quas voluptas! Harum eius eaque doloremque dolorum exercitationem adipisci porro, doloribus veniam iusto odio temporibus placeat obcaecati fugit cum totam tempore quo cumque voluptas dolores illum dolore sunt nihil incidunt. Libero quos officia dolores recusandae minima. Omnis?</p>
            </div>
            <div class="sharedwith">
                <p>Partager avec :</p>
                
            </div>
            <div class="people">
                <label for="sharedwith" class="user">none
                    
                </label>
                <label for="sharedwith" class="user"> none
                    
                </label>
                <label for="sharedwith" class="user">none</label>
            </div>
            <div class="bottompostit">
                <a href="home_post_it_view.php"><div class="closebt">fermer</div></a>
                
                <div class="form-group">
                
                </div>
            </div>
        </div>
    </div>
</form>
        </div>
        


</body>
</html>