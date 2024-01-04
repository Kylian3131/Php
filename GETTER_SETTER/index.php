<?php
class Maison{
    //ATTRIBUTS
    private $nom;
    private $longueur;
    private $largeur;
    private $nbrEtage;

    //CONSTRUCTEUR
    public function __construct($nom,$longueur,$largeur,$nbrEtage){
        $this->nom = $nom;
        $this->longueur = $longueur;
        $this->largeur = $largeur;
        $this->nbrEtage = $nbrEtage;
    }

    //GETTER ET SETTER
    public function getNom(){
        return $this->nom;
    }
    public function getLongueur(){
        return $this->longueur;
    }
    public function getLargeur(){
        return $this->largeur;
    }
    public function getEtage(){
        return $this->nbrEtage;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }
    public function setLongueur($longueur){
        $this->longueur = $longueur;
    }
    public function setLargeur($largeur){
        $this->largeur = $largeur;
    }
    public function setEtage($nbrEtage){
        $this->nbrEtage = $nbrEtage;
    }


    //METHODE
    public function surface(){
        //On part du principe que le rez de chaussé n'est pas un étage
        return $this->getLongueur() * $this->getLargeur() * ($this->getEtage() + 1);
    }

    public function display(){
        echo "<p>la surface de {$this->getNom()} est égale à : ".$this->surface()." m2</p>";
    }
}

?>