<?php
class Users{
    //ATTRIBUTS
    private $id;
    private $name_user;
    private $first_name_user;
    private $login_user;
    private $mdp_user;

    //GETTER ET SETTER
    public function getIdUser(){
        return $this->id;
    }
    public function setIdUser($id){
        $this->id = $id;
    }
    /**
     * Get the value of name_user
     */ 
    public function getName_user()
    {
        return $this->name_user;
    }

    /**
     * Set the value of name_user
     *
     * @return  self
     */ 
    public function setName_user($name_user)
    {
        $this->name_user = $name_user;

        return $this;
    }
    /**
     * Get the value of first_name_user
     */ 
    public function getFirst_name_user()
    {
        return $this->first_name_user;
    }

    /**
     * Set the value of first_name_user
     *
     * @return  self
     */ 
    public function setFirst_name_user($first_name_user)
    {
        $this->first_name_user = $first_name_user;

        return $this;
    }
    /**
     * Get the value of login_user
     */ 
    public function getLogin_user()
    {
        return $this->login_user;
    }

    /**
     * Set the value of login_user
     *
     * @return  self
     */ 
    public function setLogin_user($login_user)
    {
        $this->login_user = $login_user;

        return $this;
    }
    /**
     * Get the value of mdp_user
     */ 
    public function getMdp_user()
    {
        return $this->mdp_user;
    }
    /**
     * Set the value of mdp_user
     *
     * @return  self
     */ 
    public function setMdp_user($mdp_user)
    {
        $this->mdp_user = $mdp_user;

        return $this;
    }

    //METHODES
    public function addUser($bdd){
        try{
            //ETAPE 7 : Préparation de la requête
            $req = $bdd->prepare("INSERT INTO users (name_user, first_name_user, login_user, mdp_user) VALUES (?,?,?,?)");

            //ETAPE 8 : récupération des valeurs à enregistrer
            $name_user = $this->getName_user();
            $first_name_user = $this->getFirst_name_user();
            $login_user = $this->getLogin_user();
            $mdp_user = $this->getMdp_user();

            //ETAPE 8 : Binding de Paramètre
            $req->bindParam(1,$name_user,PDO::PARAM_STR);
            $req->bindParam(2,$first_name_user, PDO::PARAM_STR);
            $req->bindParam(3,$login_user, PDO::PARAM_STR);
            $req->bindParam(4,$mdp_user, PDO::PARAM_STR);

            //ETAPE 9 : Execution de la requête
            $req->execute();

            //ETAPE 10 : Message confirmation
            return "Login : {$login_user} <br> Nom : {$name_user} <br> Prénom : {$first_name_user} <br> Mot de Passe : {$_POST['mdp_user']}"; //-> si j'utilise $mdp_user, c'est le hash du mot de passe qui apparaîtra

        }catch(Exception $error){
            return $error->getMessage();
        }
    }

    public function getUsersAll($bdd){
        try{
            //ETAPE 7 : Préparation de la requête
            $req = $bdd->prepare("SELECT users.id_user, users.name_user, users.first_name_user, users.login_user FROM users");

            //ETAPE 8 : Execution de la requête
            $req->execute();

            //ETAPE 9 : Récupération la réponse de la BDD
            $data = $req->fetchAll();

            //ETAPE 10 : Message confirmation
            return $data;

        }catch(Exception $error){
            return $error->getMessage();
        }
    }

    public function getUserById($bdd){
        try{
            //ETAPE 7 : Préparation de la requête
            $req = $bdd->prepare("SELECT users.id_user, users.name_user, users.first_name_user, users.login_user, users.mdp_user FROM users WHERE users.id_user = ?");

            //ETAPE 8 : Récupération de l'id_user
            $idUser = $this->getIdUser();

            //ETAPE 8 : Binding de Paramètre
            $req->bindParam(1,$idUser,PDO::PARAM_INT);

            //ETAPE 9 : Execution de la requête
            $req->execute();

            //ETAPE 10 : Récupération la réponse de la BDD
            $data = $req->fetchAll();

            //ETAPE 11 : Message confirmation
            return $data;

        }catch(Exception $error){
            return $error->getMessage();
        }
    }

    function updateUserById($bdd){
        try{    
            //ETAPE 1 : preparer la requête
            $req = $bdd->prepare("UPDATE users SET name_user = ? WHERE id_user = ?;
                    UPDATE users SET first_name_user = ? WHERE id_user = ?;
                    UPDATE users SET login_user = ? WHERE id_user = ?");

            //ETAPE 2 : Récupération des données à enregistrer
            $idUser = $this->getIdUser();
            $nameUser = $this->getName_user();
            $firstNameUser = $this->getFirst_name_user();
            $loginUser = $this->getLogin_user();
            
            //ETAPE 2 : binding de paramètre
            $req->bindParam(1,$nameUser,PDO::PARAM_STR);
            $req->bindParam(2,$idUser, PDO::PARAM_INT);
            $req->bindParam(3,$firstNameUser,PDO::PARAM_STR);
            $req->bindParam(4,$idUser, PDO::PARAM_INT);
            $req->bindParam(5,$loginUser,PDO::PARAM_STR);
            $req->bindParam(6,$idUser, PDO::PARAM_INT);

            //ETAPE 2 : Execution de la requête
            $req->execute();

            //ETAPE 3 : Récupération la réponse de la BDD
            $data = $req->fetchAll();

            //ETAPE 4 : recup Message confirmation
            return "L'utilisateur a bien été mis à jour !";
        }catch(Exception $error){
            return $error->getMessage();
        }
    }
}
?>