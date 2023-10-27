<?php
class Personnage {
    protected $nom;
    public $puissance;
    public $PV;

    public function __construct($nom, $puissance, $PV) {
        $this->nom = $nom;
        $this->puissance = $puissance;
        $this->PV = $PV;
    }

    public function attaquer($cible) {
        $degats = $this->puissance;
        $cible->prendreDesDegats($degats);
        echo "\n" .$this->nom . " attaque " . $cible->nom . " pour " . $degats . " points de dégâts!\n\n";
    }

    public function prendreDesDegats($degats) {
        $this->PV -= $degats;
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

    public function getNom() {
        return $this->nom;
    }
}

class Hero extends Personnage {
    public function __construct($nom, $puissance, $PV) {
        parent::__construct($nom, $puissance, $PV);
    }
}

class Villain extends Personnage {
    public function __construct($nom, $puissance, $PV) {
        parent::__construct($nom, $puissance, $PV);
    }
}

function afficherPersonnages($personnages) {
    foreach ($personnages as $key => $personnage) {
        echo ($key + 1) . ". " . $personnage->getNom() . " (PV: " . $personnage->PV . ", "."Puissance:".$personnage->puissance.")\n";
    }
}

// Création de array des héros
$heros = [];






// Création de 5 méchants
$mechants = [];
$mechants[] = new Villain("Freezer", 100, 200);
$mechants[] = new Villain("Cell", 90, 180);
$mechants[] = new Villain("Buu", 80, 160);
$mechants[] = new Villain("C17", 70, 140);
$mechants[] = new Villain("C18", 60, 120);

echo "Bienvenue dans le jeu de combat! Vous incarnez un héros. Choisissez votre personnage:\n\n";
echo "1. Goku";
echo "2. vegeta";
echo "3. Yamcha";
echo "4. Gohan";
echo "5. Picolo";

// Sélection du héros
while (true) {
    $choixHero = readline("\nEntrez le numéro de votre personnage: ");

    switch ($choixHero){

        case '1':
        {
            $heros[] = new Hero("Goku", 100, 200);
            $heroChoisi = $heros[$choixHero - 1];
            echo "\nVous avez choisi " . $heroChoisi->getNom() . ".\n";
            break 2;
        }
        case '2':
        {
            $heros[] = new Hero("Vegeta", 90, 180);
            $heroChoisi = $heros[$choixHero - 2];
            echo "\nVous avez choisi " . $heroChoisi->getNom() . ".\n";
            break 2;
    
        }
        case '3':
        {
            $heros[] = new Hero("Yamcha", 80, 160);
            $heroChoisi = $heros[$choixHero - 3];
            echo "\nVous avez choisi " . $heroChoisi->getNom() . ".\n";
            break 2;
        }
        case '4':
        {   
            $heros[] = new Hero("Gohan", 70, 140);
            $heroChoisi = $heros[$choixHero - 4];
            echo "\nVous avez choisi " . $heroChoisi->getNom() . ".\n";
            break 2;
        }
        case '5':
        {
            $heros[] = new Hero("Piccolo", 60, 120);
            $heroChoisi = $heros[$choixHero - 5];
            echo "\nVous avez choisi " . $heroChoisi->getNom() . ".\n";
            break 2;
        }
        default:
        {
            echo "Choix invalide. Veuillez entrer un numéro valide.\n";
            break;
        }


    }
}

echo "\nVous êtes prêt à combattre! Sélectionnez un méchant pour l'attaquer:\n\n";
afficherPersonnages($mechants);

// Combat
while (!empty($mechants) && $heroChoisi->estVivant()) {
    $choixAttaque = readline("\nEntrez le numéro du méchant que vous souhaitez attaquer (ou 'q' pour quitter): ");
    

    if ($choixAttaque === 'q') {
        break;
    }

    if ($choixAttaque >= 1 && $choixAttaque <= count($mechants)) {
        $mechantCible = $mechants[$choixAttaque - 1];
        $heroChoisi->attaquer($mechantCible);
        

        foreach ($mechants as $key => $mechant) {
            if (!$mechant->estVivant()) {
                unset($mechants[$key]);

            }
        }
        
        afficherPersonnages($mechants);

        $mechantCible->attaquer($heroChoisi);

        afficherPersonnages($heros);
        

    } else {
        echo "Choix invalide. Veuillez entrer un numéro valide.\n";
    }
    
    // faire le système d'attaque des méchants


}

if (empty($mechants)) {
    echo "Félicitations! Vous avez vaincu tous les méchants!\n";
} else {
    echo "Vous avez été vaincu par les méchants. Meilleure chance la prochaine fois!\n";
}
?>
