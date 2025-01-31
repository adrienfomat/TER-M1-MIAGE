<?php 

/* Fonction Connexion a la base de données */
function connexion(){
    $host = 'localhost';
    $dbname = 'TER_DB';
    $username = 'root';
    $password = '';
    
    try {
        $db_connexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        return $db_connexion;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


/* On verifie si la connexion est établie */
$db_connexion = connexion();
if ($db_connexion) {
    echo "Connexion réussie .";
} else {
    echo "Échec de connexion .";
}
?>