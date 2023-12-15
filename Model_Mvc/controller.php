<?php
require_once './model.php';
$message='';

function addUser()
{
    if (isset($_POST['submitInscription'])) {
        if (
            isset($_POST["name_user"]) && !empty($_POST["name_user"])
            && isset($_POST["first_name_user"]) && !empty($_POST["first_name_user"])
            && isset($_POST["login_user"]) && !empty($_POST["login_user"])
            && isset($_POST["mdp_user"]) && !empty($_POST["mdp_user"])
        ) {

            $name_user = htmlentities(strip_tags(trim($_POST["name_user"])));
            $first_name_user = htmlentities(strip_tags(trim($_POST["first_name_user"])));
            $login_user = htmlentities(strip_tags(trim($_POST["login_user"])));
            $mdp_user = htmlentities(strip_tags(trim($_POST["mdp_user"])));

            // Hashage du mot de passe
            $mdp_user = password_hash($mdp_user, PASSWORD_BCRYPT);
            createUser($name_user, $first_name_user, $login_user, $mdp_user);
            $message = 'Utilisateur enregistré avec succès';
        }
    }
}

if (isset($_POST['submitInscription'])) {
    addUser();
}


?>