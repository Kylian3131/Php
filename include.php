<?php
    $message = "";

    //ETAPE 1 : je vérifie que le formulaire a été envoyé au serveur
    if(isset($_POST['submitInscription'])){
        //ETAPE 2 : Sécurité - Vérifier si les champs nécessaires sont bien remplie
        if(isset($_POST["login_user"]) && !empty($_POST["login_user"])
        && isset($_POST["mdp_user"]) && !empty($_POST["mdp_user"])){

            //ETAPE 3 : Sécurité - nettoyage des données
            $name_user = htmlentities(strip_tags(trim($_POST["name_user"])));
            $first_name_user = htmlentities(strip_tags(trim($_POST["first_name_user"])));
            $login_user = htmlentities(strip_tags(trim($_POST["login_user"])));
            $mdp_user = htmlentities(strip_tags(trim($_POST["mdp_user"])));

            //ETAPE 4 : Sécurité - hashage du mot de passe
            $mdp_user = password_hash($mdp_user,PASSWORD_BCRYPT);

            //ETAPE 5 : Sécurité - vérifie le format des données
            //-> Ici pas de vérification car pas de format spécial attendu en dehors des STRING

            //ETAPE 6 : Communication à la BDD - Connexio
            try{
                $bdd = new PDO("mysql:host=localhost;dbname=task3","root","root",
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

                //ETAPE 7 : Préparation de la requête
                $req = $bdd->prepare("INSERT INTO users (name_user, first_name_user, login_user, mdp_user) VALUES (?,?,?,?)");

                //ETAPE 8 : Binding de Paramètre
                $req->bindParam(1,$name_user,PDO::PARAM_STR);
                $req->bindParam(2,$first_name_user, PDO::PARAM_STR);
                $req->bindParam(3,$login_user, PDO::PARAM_STR);
                $req->bindParam(4,$mdp_user, PDO::PARAM_STR);

                //ETAPE 9 : Execution de la requête
                $req->execute();

                //ETAPE 10 : Message confirmation
                $message = "Login : {$login_user} <br> Nom : {$name_user} <br> Prénom : {$first_name_user} <br> Mot de Passe : {$_POST['mdp_user']}"; //-> si j'utilise $mdp_user, c'est le hash du mot de passe qui apparaîtra 

            }catch(Exception $error){
                $message = $error->getMessage();
            }
        }else{
            $message = "Remplissez correctement le Formulaire";
        }

        
    }
?>

<?php include ('header.php'); ?>