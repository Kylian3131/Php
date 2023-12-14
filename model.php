<?php class UserModel {
    public function createUser($name_user, $first_name_user, $login_user, $mdp_user) {
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=task3","root","root", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $req = $bdd->prepare("INSERT INTO users (name_user, first_name_user, login_user, mdp_user) VALUES (?,?,?,?)");
            $req->execute([$name_user, $first_name_user, $login_user, $mdp_user]);
            return true;
        } catch(Exception $error) {
            return $error->getMessage();
        }
    }
}

?>