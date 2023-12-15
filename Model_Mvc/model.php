<?php 

function connectToDatabase(){
    try {
        return new PDO("mysql:host=localhost;dbname=task", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch(Exception $error){
        die("Erreur de connexion a la base de donnée : ".$error->getMessage());
    }
}


connectToDatabase();


function createUser($name_user, $first_name_user, $login_user, $mdp_user_) {
    $bdd = connectToDatabase();
    $req = $bdd->prepare("INSERT INTO userr (name_user, first_name_user, login_user, mdp_user_) VALUES (?,?,?,?)");
    $req -> execute([$name_user, $first_name_user, $login_user, $mdp_user_]);
}

?>