<?php
//LE CONTROLLER POUR LES CATEGORY

//IMPORT DE MES RESSOURCES
include './utils/functions.php';
include './utils/bdd.php';
include './model/model_category.php';

$message = "";
$messageCat = "";
$catOption = "";
$messageUpdate = "";


/***********************
AJOUTER UNE CATEGORY
************************/
if(isset($_POST['addCat'])){
    //ETAPE 1 : SECURITE - vérifier les champs vide
    if(isset($_POST['name_cat']) and !empty($_POST['name_cat'])){
        //ETAPE 2 : SECURITE - nettoyage des données
        $nameCat = sanitize($_POST['name_cat']);

        //ETAPE 3 : appeler la fonction du model permettant l'enregistrement en BDD
        $message = addCategory($nameCat, $bdd);
    }
}

/******************************
AFFICHER TOUTES LES CATEGORIES
*******************************/
//ETAPE 1 : lance la fonction du model
$data = getCategoryAll($bdd);

//ETAPE 2 : faire la boucle qui crée les Card Category
foreach($data as $category){
    $messageCat = $messageCat."<article>
    <p>Catégorie: {$category['name_cat']}</p>
</article>";
}

/***********************************************
CREATION FORM OPTION POUR LE SELECT DE CATEGORY
************************************************/
//ETAPE 1 : Recupérer les datas de mes catégories
//-> c'est la variable $data

//ETAPE 2 : créer la boucle pour créer les options et les passer à la vue
foreach($data as $category){
    $catOption = $catOption."<option value='{$category['id_cat']}'>{$category['name_cat']}</option>";
}

/******************************
    MODIFIER UNE CATEGORIE
*******************************/
if(isset($_POST['updateCat'])){
    //ETAPE 1 : vérifier les champs
    if(isset($_POST["catSelect"]) and !empty($_POST["catSelect"])
        and isset($_POST["newNameCat"]) and !empty($_POST["newNameCat"])){
            //ETAPE 2 : nettoyage des données
            $idCat = sanitize($_POST["catSelect"]);
            $newNameCat = sanitize($_POST["newNameCat"]);

            //ETAPE 3 : vérification du format
            if(filter_var($idCat, FILTER_VALIDATE_INT)){
                //ETAPE 4 : lancer ma fonction de modification
                $messageUpdate = updateCatById($idCat, $newNameCat, $bdd);

            }else{
                $messageUpdate = "Problème avec la catégorie à modifer";
            }
    }else{
        $messageUpdate = "Veuillez remplir correctement le formulaire !";
    }
}

include "./view/header.php";
include "./view/view_category.php";
include "./view/footer.php";
?>