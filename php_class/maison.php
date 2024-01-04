<?php
class maison
{
    public $nom;
    public $longueur;
    public $largeur;

    public function surface()
    {
        $surface = $this->longueur * $this->largeur;
        echo "La superficie de la maison est de " . $surface . " mètres carrés.";
    }
}
















?>