<?php /*Exercice 19 : Communication avec une BDD
a) Créer une base de données MYSQL avec les informations suivantes :
-Nom de la bdd : « articles »,
-une table nommée article qui va posséder les champs suivants :
id_article (clé primaire),
nom_article de type varchar(50),
contenu_article de type varchar (255),

b) Créer une page php qui va contenir un formulaire html avec comme méthode POST (balise form)
-A l’intérieur du formulaire rajouter les champs suivants :
Un champ input avec comme attribut html name = «nom_article »,
Un champ input avec comme attribut html name = «contenu_article »,
Un champ input de type submit avec comme attribut html value = «Ajouter»

c) Ajouter le code php suivant :
-Créer 2 variables $name, $content
-Importer le contenu des 2 super globales $_POST[‘nom_article’], $_POST[‘contenu_article’] et tester les avec la méthode isset() dans les variables créés précédemment ($name et $content),
-Ajouter le code de connexion à la base de données en vous inspirant des exemples vus dans ce chapitre,
-Utiliser une requête SQL préparée avec Binding de Paramètres à la place de la requête simple.
-Afficher dans un paragraphe le nom et le contenu de l’article ajouté en bdd en dessous du formulaire.

NOTE IMPORTANTE : Sécuriser votre back-end

Exercice 20 :
a) Créer une page php,
b) Ajouter le script php permettant de se connecter à la base de données articles,
c) Ajouter le script php qui va effectuer une requête SQL select préparée permettant de récupérer tous les articles,
d) Formater le résultat de la requête (dans le résultat de la boucle while) pour quelle l’affiche sous cette forme :

<p>numéro de l’article : id de l’article n</p>
<br>
<p>nom de l’article : nom de l’article n</p>
<br>
<p>contenu de l’article : contenu de l’article n</p>
<br>*/

    //Je déclare des variables que je vais utiliser potentiellement dans chaque bloc de code
    $message ='';
    $name ='';
    $content ='';
    $showArticle = '';

    if(isset($_POST['submit'])){
        //SECURITE ETAPE 1 : vérifie les données, si elles sont vide ou non
        if(isset($_POST['nom_article']) && !empty($_POST['nom_article']) 
            && isset($_POST['contenu_article']) && !empty($_POST['contenu_article'])){

            //SECURITE ETAPE 2 : nettoyage
            $name = htmlentities(strip_tags(trim($_POST['nom_article'])));
            $content = htmlentities(strip_tags(trim($_POST['contenu_article'])));

            //SECURITE ETAPE 3 : vérifie le format des données
            //-> ici on a que des strings, donc pas besoin de vérification

            //COMMUNICATION AVEC LA BDD
            try{
                //ETAPE 1 : Se connecter à la BDD
                $bdd = new PDO('mysql:host=localhost;dbname=articles','root','root',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

                //ETAPE 2 : Préparer la requête
                $req=$bdd->prepare('INSERT INTO article (nom_article, contenu_article) VALUES(?,?)');

                //ETAPE 3 : Binding de Paramètre
                $req->bindParam(1,$name,PDO::PARAM_STR);
                $req->bindParam(2,$content,PDO::PARAM_STR);

                //ETAPE 4 : Exécution de la requête
                $req->execute();

                $message = "L'article : $name, a bien été ajouté à la BDD.";

            }catch(Exception $error){
                $message = $error;
            }
        }
        else {
            //J'affiche un message d'erreur si le formulaire n'est paz correctement rempli
            $message = 'Remplissez correctement le formulaire';
        }
    }
    try{
        //ETAPE 1 : Connection à la BDD
        $bdd = new PDO('mysql:host=localhost;dbname=articles','root','root',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
        //ETAPE 2 : Préparation de la requête
        $req=$bdd->prepare('SELECT article.id_article, article.nom_article, article.contenu_article FROM article');

        //ETAPE 3 : Exécuter la requête
        $req->execute();

        //ETAPE 4 : Récupération des données
        $data=$req->fetchAll();

        foreach($data as $article){
            $showArticle = $showArticle."<p>numéro de l'article : {$article['id_article']}</p>
            <p>nom de l'article : {$article['nom_article']}</p>
            <p>contenu de l'article : {$article['contenu_article']}</p>
            <br><br>";
        }

    }catch(Exception $error){
        $showArticle = $error->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="bdd.php" method="POST">
        <input type="text" name="nom_article" placeholder="nom de l'article">
        <input type="text" name="contenu_article" placeholder="description de l'article">
        <input type="submit" name="submit">
    </form>

    <p><?php echo $message ?></p>

    <p><?php echo $showArticle ?></p>
</body>
</html>