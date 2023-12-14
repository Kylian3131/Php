<?php
include 'model.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function register() {
        if(isset($_POST['submitInscription'])) {
            // Vérification et traitement des données ici...

            // Hashage du mot de passe
            $mdp_user = password_hash($mdp_user, PASSWORD_BCRYPT);

            // Appel au modèle pour créer l'utilisateur
            $result = $this->userModel->createUser($name_user, $first_name_user, $login_user, $mdp_user);
            if ($result === true) {
                $message = "Utilisateur créé avec succès";
            } else {
                $message = $result; // message d'erreur retourné par le modèle
            }

            // Charge la vue avec le message
            include 'inscriptionView.php';
        }
    }
}

$controller = new UserController();
$controller->register();

?>