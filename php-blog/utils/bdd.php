<?php

try {
    $connectToDatabase = new PDO("mysql:host=localhost;dbname=blog", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $error) {
    die("Erreur de connexion à la base de données : " . $error->getMessage());
}

?>
