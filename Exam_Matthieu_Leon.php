<?php


abstract class personnage{
    protected $nom;
    protected $puissance;
    protected $PV;
    protected $profession;
    protected $attaque_sp;


    
    public function attaquer($cible) {
        $degats = $this->puissance;
        $cible->prendreDesDegats($degats);
        echo $this->nom . " attaque " . $cible->nom . " pour " . $degats . " points de dégâts!\n";
    }

    public function prendreDesDegats($degats) {
        $this->PV -= $degats;
        return $this->PV > 0;
        if ($this->PV <= 0) {
            $this->mourir();
        }
        
    }

    public function mourir() {
        echo $this->nom . " est mort.\n";
    }
    public function estVivant() {
        return $this->PV > 0;
        
    }

}


class Hero extends personnage{
    public function __construct($nom,$puissance,$PV,$profession,$attaque_sp) {
        $this->nom = $nom;
        $this->puissance=$puissance;
        $this->PV=$PV;
        $this->profession= $profession;
        $this->attaque_sp= $attaque_sp;
    }
}

class Villain extends personnage{
    public function __construct($nom,$puissance,$PV,$profession) {
        $this->nom = $nom;
        $this->puissance=$puissance;
        $this->PV=$PV;
        $this->profession= $profession;  
    }
}



// Création de 5 vilains
$villain1 = new Villain("Freezer","500","50","villain");
$villain2 = new Villain("Cell","600","150","villain");
$villain3 = new Villain("Buu","700","250","villain");
$villain4 = new Villain("C17","800","350","villain");
$villain5 = new Villain("C18","900","450","villain");

// Création de 5 héros
$hero1 = new Hero("Goku","600","200","hero","Kamehameha");
$hero2 = new Hero("Vegeta","700","250","hero","final flash");
$hero3 = new Hero("Yamcha","800","300","hero","technique du loup");
$hero4 = new Hero("Gohan","900","350","hero","masenko");
$hero5 = new Hero("Piccolo","1000","400","hero","light grenade");



?>