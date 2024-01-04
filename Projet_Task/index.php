<?php
//include de mes ressources
include './utils/bdd.php';
include './model/model_users.php';
include './utils/functions.php';

class ControlerUsers{
    //ATTRIBUTS
    private $message;
    private $showUsers;
    private $formUpdateUser;
    private $messageUpdate;
    private $selectUser;

    //GETTER ET SETTER
    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of showUsers
     */ 
    public function getShowUsers()
    {
        return $this->showUsers;
    }

    /**
     * Set the value of showUsers
     *
     * @return  self
     */ 
    public function setShowUsers($showUsers)
    {
        $this->showUsers = $showUsers;

        return $this;
    }

    /**
     * Get the value of formUpdateUser
     */ 
    public function getFormUpdateUser()
    {
        return $this->formUpdateUser;
    }

    /**
     * Set the value of formUpdateUser
     *
     * @return  self
     */ 
    public function setFormUpdateUser($formUpdateUser)
    {
        $this->formUpdateUser = $formUpdateUser;

        return $this;
    }

    /**
     * Get the value of messageUpdate
     */ 
    public function getMessageUpdate()
    {
        return $this->messageUpdate;
    }

    /**
     * Set the value of messageUpdate
     *
     * @return  self
     */ 
    public function setMessageUpdate($messageUpdate)
    {
        $this->messageUpdate = $messageUpdate;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getSelectUser()
    {
        return $this->selectUser;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setSelectUser($selectUser)
    {
        $this->selectUser = $selectUser;

        return $this;
    }
    

    //METHODES
    //Afficher la page Index
    public function showIndex(){
        $showUsers = $this->getShowUsers();
        $message = $this->getMessage();
        $formUpdateUser = $this->getFormUpdateUser();
        $messageUpdate = $this->getMessageUpdate();
        $selectUser = $this->getSelectUser();

        include './view/header.php';
        include './view/view_users.php';
        include './view/footer.php';
    }

    /************************************
        AFFICHAGE UTILISATEUR
    ************************************/
    public function showUsers($bdd){
        //ETAPE 1 : Appeler la fonction getUsersAll() du model
        $users = new Users();
        $data = $users->getUsersAll($bdd);

        //ETAPE 2 : Traiter mon tableau $data grâce à une boucle pour remplir la variable $showUsers qui va afficher les users dans la vue.
        $i = 1;
        $showUsers = '';
        foreach($data as $user){
            $showUsers = $showUsers."<article>
                <h2>Utilisateur {$i}</h2>
                <p>Login : {$user['login_user']}</p>
                <p>Nom : {$user['name_user']}</p>
                <p>Prénom : {$user['first_name_user']}</p>
            </article>";
            $i++;
            $this->setShowUsers($showUsers);
        }
    }

    /************************************
        ENREGISTREMENT D'UN UTILISATEUR
    ************************************/
    public function addUserControler($bdd){
        //ETAPE 1 : je vérifie que le formulaire a été envoyé au serveur
        if(isset($_POST['submitInscription'])){
            //ETAPE 2 : Sécurité - Vérifier si les champs nécessaires sont bien remplie
            if(isset($_POST["login_user"]) && !empty($_POST["login_user"])
            && isset($_POST["mdp_user"]) && !empty($_POST["mdp_user"])){

                //ETAPE 3 : Sécurité - nettoyage des données en appelant ma fonction utilitaire sanitize (voir le fichier functions.php)
                $user = new Users();
                $user->setName_user(sanitize($_POST["name_user"]));
                $user->setFirst_name_user(sanitize($_POST["first_name_user"]));
                $user->setLogin_user(sanitize($_POST["login_user"]));
                $user->setMdp_user(sanitize($_POST["mdp_user"]));

                //ETAPE 4 : Sécurité - hashage du mot de passe
                $user->setMdp_user(password_hash($user->getMdp_user(),PASSWORD_BCRYPT));

                //ETAPE 5 : Sécurité - vérifie le format des données
                //-> Ici pas de vérification car pas de format spécial attendu en dehors des STRING
            
                //ETAPE 6 : Appeler la fonction du model permettant d'enregister un utilisateur
                $this->setMessage($user->addUser($bdd));

            }else{
                $this->setMessage("Remplissez correctement le Formulaire");
            }

        }
    }

    /**************************************************
    RECUP UTILISATEUR POUR BALISE SELECT : $selectUser
    ***************************************************/
    public function recupSelect($bdd){
        //ETAPE 1 : récupérer l'ensemble des données Utilisateur
        //-> c'est déjà fait à l'étape du dessus, grâce à $data
        $user = new Users();
        $data = $user->getUsersAll($bdd);

        //ETAPE 2 : créer notre liste de balise option rempli avec le login des utilisateurs
        $selectUser = "";
        foreach($data as $user){
            $selectUser = $selectUser."<option value='{$user['id_user']}'>{$user['login_user']}</option>";
        }
        $this->setSelectUser($selectUser);
    }

    //ETAPE 3 : Récupérer l'utilisateur à modifier pour générer le formulaire de modification
    public function formUpdateUser($bdd){
        //Vérifie que quelqu'un souhaite modifer un utilisateur -> je vérifie que $_POST["submitSelect"] existe
        if(isset($_POST["submitSelect"])){
            //Récupère les infos de l'utilisateur à modifier grâce à $data
            //SECURITE 1 : vérifier les champs
            if(isset($_POST["selectUser"]) && !empty($_POST["selectUser"])){
                //SECURITE 2 : nettoyage des données
                $user = new Users();
                $user->setIdUser(sanitize($_POST["selectUser"]));

                //SECURITE 3 : vérification du format des données
                if(filter_var($user->getIdUser(), FILTER_VALIDATE_INT)){
                    //Récupérer les données du user dans $data
                    $data = $user->getUsersAll($bdd);
                    $userSelected = "";
                    foreach($data as $userUpdate){
                        if($userUpdate['id_user'] == $user->getIdUser()){
                            $userSelected = $userUpdate;
                        }
                    }

                    //Génère le formulaire de modification
                    $formUpdateUser = "<form action='index.php' method='POST'>
                        <input type='text' name='name_userUpdate' placeholder='Le Nom' value='{$userSelected['name_user']}' required>
                        <input type='text' name='first_name_userUpdate' placeholder='Le Prénom' value='{$userSelected['first_name_user']}' required>
                        <input type='text' name='login_userUpdate' placeholder='Votre Login' required value='{$userSelected['login_user']}'>
                        <input type='password' name='mdp_userUpdate' placeholder='Votre mot de passe' required>
                        <input type='text' name='number_userUpdate' value='{$userSelected['id_user']}' required style='display:none'>
                        <input type='submit' value='Modifer' name='submitUpdate'>
                    </form>";
                    $this->setFormUpdateUser($formUpdateUser);
                } else {
                    $this->setFormUpdateUser("problème sur le login envoyé");
                }
            }else {
                $this->setFormUpdateUser("formulaire mal rempli");
            }
        }
    }

    /**************************************************
        MODIFIER UN UTILISATEUR
    ***************************************************/
    public function updateUser($bdd){
        if(isset($_POST['submitUpdate'])){
            //RECUPERATION DES DONNEES
            //ETAPE 1 : SECURITE - vérifier les champs
            if(isset($_POST['name_userUpdate']) and !empty($_POST['name_userUpdate'])
                and isset($_POST['first_name_userUpdate']) and !empty($_POST['first_name_userUpdate'])
                and isset($_POST['login_userUpdate']) and !empty($_POST['login_userUpdate'])
                and isset($_POST['mdp_userUpdate']) and !empty($_POST['mdp_userUpdate'])
                and isset($_POST['number_userUpdate']) and !empty($_POST['number_userUpdate'])){

                    //ETAPE 2 : SECURITE - nettoyage des données
                    $user = new Users();
                    $user->setName_user(sanitize($_POST['name_userUpdate']));
                    $user->setFirst_name_user(sanitize($_POST['first_name_userUpdate']));
                    $user->setLogin_user(sanitize($_POST['login_userUpdate']));
                    $user->setMdp_user(sanitize($_POST['mdp_userUpdate']));
                    $user->setIdUser(sanitize($_POST['number_userUpdate']));

                    //ETAPE 3 : SECURITE - vérifier le format de mon id
                    if(filter_var($user->getIdUser(), FILTER_VALIDATE_INT)){

                        //ETAPE 4 - SECURITE - vérifier si le mot de passe est le bon
                        //recupération du hash
                        $data = $user->getUserById($bdd);
                        $mdpHash = $data[0]['mdp_user'];
                        if(password_verify($user->getMdp_user(), $mdpHash)){
                            //LANCER LA REQUÊTE DE MODIF
                            $messageUpdate = $user->updateUserById($bdd);
                            $this->setMessageUpdate($messageUpdate);
                        }
                    }
            }
        }
    }



}

$controlerUsers = new ControlerUsers();
$controlerUsers->showUsers($bdd);
$controlerUsers->addUserControler($bdd);
$controlerUsers->recupSelect($bdd);
$controlerUsers->formUpdateUser($bdd);
$controlerUsers->updateUser($bdd);
$controlerUsers->showIndex();

    
?>