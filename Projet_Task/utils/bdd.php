<?php
    //ETAPE 6 : Communication à la BDD - Connexion
    $bdd = new PDO("mysql:host=localhost;dbname=task","root","",
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>