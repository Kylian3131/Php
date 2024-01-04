<?php
class Categories{
    //ATTRIBUTS
    private $id;
    private $nameCat;
    
    //GETTER ET SETTER
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nameCat
     */ 
    public function getNameCat()
    {
        return $this->nameCat;
    }

    /**
     * Set the value of nameCat
     *
     * @return  self
     */ 
    public function setNameCat($nameCat)
    {
        $this->nameCat = $nameCat;

        return $this;
    }

    //METHODES
    public function addCategory($bdd){
        try{
            //Preparation de ma requête
            $req=$bdd->prepare('INSERT INTO  categories (name_cat) VALUES(?)');

            //Recupération des données
            $nameCat = $this->getNameCat();

            //binding de param
            $req->bindParam(1,$nameCat,PDO::PARAM_STR);

            //Exécution de la requête
            $req->execute();

            //Retourner un message de confirmation
            return "la catégorie : $nameCat a été ajouté avec succès.";


        }catch(Exception $error){
            return $error->getMessage();
        }
    }

    public function getCategoryAll($bdd){
        try{
            //Preparation de la requête
            $req=$bdd->prepare('SELECT id_cat, name_cat FROM categories');

            //Exécution de la requête
            $req->execute();

            //Récupérer la réponse de la BDD
            $data = $req->fetchAll();

            //Retourner les données au Controller
            return $data;

        }catch(Exception $error){
            return $error->getMessage();
        }
    }

    public function updateCatById($bdd){
        try{
            //Preparation de la requête
            $req=$bdd->prepare('UPDATE categories SET name_cat = ? WHERE id_cat = ?');

            //Récupération des données
            $idCat = $this->getId();
            $newNameCat = $this->getNameCat();

            //Binding de Paramètre
            $req->bindParam(1,$newNameCat,PDO::PARAM_STR);
            $req->bindParam(2,$idCat,PDO::PARAM_INT);

            //Exécution de la requête
            $req->execute();


            //Retourner les données au Controller
            return "La Modification de votre catégorie s'est bien déroulé";

        }catch(Exception $error){
            return $error->getMessage();
        }
    }

}
?>