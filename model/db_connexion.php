<?php 

/* Fonction Connexion a la base de données */
function connexion(){
    $host = "192.168.137.110"; //pour permettre les connexions depuis un autre poste
    $dbname = 'TER_DB';
    $username = 'root';
    $password = '';
    
    try {
        $db_connexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $db_connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db_connexion;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


/* On verifie si la connexion est établie */
$db_connexion = connexion();
if ($db_connexion) {
    //echo "Connexion réussie .";
} else {
    //echo "Échec de connexion .";
}
?>