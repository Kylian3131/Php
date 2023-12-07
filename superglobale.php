<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <style>
        h1 {
            font-family: Arial;
            text-align: center;
            color: orange;
        }
    </style>

    <h1>Exercice Php</h1>


    <form method="POST">
        <ul>
            <li>
                <label for="name">nom_article&nbsp;:</label>
                <input type="text" id="name" name="nom_article" />
            </li>
            <li>
                <label for="mail">contenu_article&nbsp;:</label>
                <input type="text" id="mail" name="contenu_article" />
            </li>
            <li>
                <input type="submit" value="Ajoutera">
            </li>
        </ul>
    </form>

    <?php


    // Exercice 17 - SuperGlobal GET et POST :
    
    /*  $num1 = $_POST["nombre"];
        $num2 = $_POST["nombre1"];
        echo "Le resultat de cette addition est ".$num1+$num2; */

    // ------------------------------------------------------------------------------------------------
    

    // Exercice 18 --Créer une page de formulaire dans laquelle on aura 3 champs de formulaire de type nombre :
    /* 1 champ de formulaire qui demande un prix HT d’un article,
    1 champ de formulaire qui demande le nombre d’article,
    1 champ de formulaire qui demande le taux de TVA,
    -Afficher dans cette même page le prix TTC (prix HTtaux TVAquantité) avec un affichage du style :
    Le prix TTC est égal à : valeur €. */

    // $num1 = $_POST["nombre"];
    // $num2 = $_POST["nombre1"];
    // $num3 = $_POST["nombre2"];
    
    // $ttc = ($num1 / 100) * $num3;
    // echo "Le prix ttc de votre produit est de ".$ttc;
    

    // ------------------------------------------------------------------------------------------------
    
    // Exercice 19: Communication avec une BDD
    
    $name = $_POST["nom_article"];
    $content = $_POST["contenu_article"];

    if (isset($name) && isset($content)) {
        echo "Le formulaire est bien rempli <br><br>";


        $bdd = new PDO('mysql:host=localhost;dbname=article', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $req = $bdd->prepare("INSERT INTO article (nom_article, contenu_article) VALUES (?,?)");

        $req->execute([$name, $content]);

        $data = $req->fetch();

        // var_dump($data);
    
        echo "Ajout de {$name} et de {$content} bien pris en compte !!!";



        // Exercice 20: /* a) Créer une page php,
        /* b) Ajouter le script php permettant de se connecter à la base de données articles,
        c) Ajouter le script php qui va effectuer une requête SQL select préparée permettant de récupérer tous les articles,
        d) Formater le résultat de la requête (dans le résultat de la boucle while) pour quelle l’affiche sous cette forme :

        <p>numéro de l’article : id de l’article n</p>
        <br>
        <p>nom de l’article : nom de l’article n</p>
        <br>
        <p>contenu de l’article : contenu de l’article n</p>
        <br> */

        $req1 = $bdd->prepare("SELECT * FROM article");

        $req1->execute();

        $data1 = $req1->fetchAll();

        foreach ($data1 as $value) {
            echo "<p>Numéro de l'article : {$value['id_article']} </p>
        <p>Nom de l'article :  {$value['nom_article']} </p>
        <p>Description de l'article : {$value['contenu_article']} </p>";
        }
    }






    ?>
</body>

</html>