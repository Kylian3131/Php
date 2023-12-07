<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            font-family: Arial;
            text-align: center;
            color: orange;
        }

        form {
            display: flex;
        }

        h2 {
            color: red;
        }
    </style>
</head>

<body>

    <h1>Exercice Php</h1>

    <h2>Champs Utilisateur</h2>

    <form method="post">
        <label for="name_user">Nom :</label>
        <input type="text" id="name_user" name="name_user" required><br>

        <label for="first_name_user">Prénom :</label>
        <input type="text" id="first_name_user" name="first_name_user" required><br>

        <label for="login_user">Login :</label>
        <input type="text" id="login_user" name="login_user" required><br>

        <label for="mdp_user">Mot de passe :</label>
        <input type="password" id="mdp_user" name="mdp_user" required><br>

        <input type="submit" value="Ajouter">
    </form>

    <br><br>

    <h2>Champs category</h2>

    <form method="post">
        <label for="name_user">Nom catégorie :</label>
        <input type="text" id="name_user" name="categorie" required><br>

        <input type="submit" value="Ajouter">
    </form>

    <br><br>

    <?php

    $name_user = $_POST["name_user"];
    $first_name_user = $_POST["first_name_user"];
    $login_user = $_POST["login_user"];
    $mdp_user = $_POST["mdp_user"];

    if (isset($name_user) && isset($first_name_user) && isset($login_user) && isset($mdp_user)) {
        echo "Le formulaire est bien rempli <br><br>";

        $bdd = new PDO('mysql:host=localhost;dbname=task', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $req = $bdd->prepare("INSERT INTO userr (name_user, first_name_user, login_user, mdp_user_) VALUES (?,?,?,?)");

        $req->execute([$name_user, $first_name_user, $login_user, $mdp_user]);

        $data = $req->fetch();

        echo "Ajout de {$name_user} et de votre nom de famille: {$first_name_user}, ainsi que de ton identifiant {$login_user}, et on mot de passe fait attention avec celui-ci donnée sensible: {$mdp_user} !!!";
    }

    // ---------------------------------------------------------------------------------------------

        $categorie = $_POST["categorie"];

        if (isset($categorie)) {
            echo "Le formulaire est bien rempli <br><br>";


            $req1 = $bdd->prepare("SELECT * FROM userr");

            $req1->execute();

            $data1 = $req1->fetchAll();

            foreach ($data1 as $value) {
                echo "<p>Nom : {$value['name_user']} </p>
        <p>Nom de famille :  {$value['first_name_user']} </p>
        <p>Nom d'utilisateur : {$value['login_user']} </p>
        <p>Mot de passe {$value['mdp_user_']} </p>";
            }
        

        $req2 = $bdd->prepare("SELECT * FROM userr");




    }





    ?>

</body>

</html>