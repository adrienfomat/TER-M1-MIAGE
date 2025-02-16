

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
    <title>Accueil</title>
    
</head>
<body>
    
    

    
    <div class="left-bar"></div>
   <div class="left-btn">
   </div> 
    
    
   <form action="/TER_MIAGE/control/create_post_it.php" method="POST">
    <div class="main-box">
        <div class="box">
            <div class="titre">
            <label for="title" class="titre1">Titre</label>
                <input type="text" name="title" id="title" class="form-control" required>
                <p><b>27/03/2002</b></p>
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
                <label for="sharedwith" class="user">Fallou
                    <span class="delete-icon">&times;</span>
                </label>
                <label for="sharedwith" class="user">Hamza
                    <span class="delete-icon">&times;</span>
                </label>
                <label for="sharedwith" class="user">Soumaya
                    <span class="delete-icon">&times;</span>
                </label>
            </div>
            <div class="bottompostit">
                <button type="submit" class="save-button">SAVE</button>
                <div class="color-palette">
                    <div class="color" style="background-color: red;" onclick="selectColor(event)"></div>
                    <div class="color" style="background-color: lightcoral;" onclick="selectColor(event)"></div>
                    <div class="color" style="background-color: lightgreen;" onclick="selectColor(event)"></div>
                    <div class="color" style="background-color: brown;" onclick="selectColor(event)"></div>
                    <div class="color" style="background-color: yellow;" onclick="selectColor(event)"></div>
                    <div class="color" style="background-color: darkblue;" onclick="selectColor(event)"></div>
                    <div class="color" style="background-color: lightblue;" onclick="selectColor(event)"></div>
                </div>
            </div>
        </div>
    </div>
</form>
        </div>
        <div class="right-bar"></div>
        
    
    

<script src="script.js"></script>
</body>
</html>