<?php
    //On declare la classe personnage
class Personnage {
        //on lui assigne 3 attributs principaux dans un jeux de combat 

    protected $nom;
    public $puissance;
    public $PV;
        //On assemble les personnage grace au construct

    public function __construct($nom, $puissance, $PV) {
        $this->nom = $nom;
        $this->puissance = $puissance;
        $this->PV = $PV;
    }

    //on Viens creer plusieurs methode que nous utiliseront plus tard

//la methode attaquer() pour que les degat aillent sur les villains et non pas les heros
    public function attaquer($cible) {
        $degats = $this->puissance;
        $cible->prendreDesDegats($degats);
        echo "\n" . $this->nom . " attaque " . $cible->nom . " pour " . $degats . " points de dégâts!\n\n";
    }

//Pour aussi que les degat sois lié a la puissance de l'adversaire
    public function prendreDesDegats($degats) {
        $this->PV -= $degats;
        if ($this->PV <= 0) {
            $this->mourir();
        }
    }
//la methode pour afficher un message si un heros ou un enemis est mort
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

//On creer les classe heros/villains heritiere de la classe personnage 
//On commence par la classe hero ou on lui assigne les PV, la puissance et un nom
class Hero extends Personnage {
    public function __construct($nom, $puissance, $PV) {
        parent::__construct($nom, $puissance, $PV);
    }
}
//pareil pour les villains
class Villain extends Personnage {
    public function __construct($nom, $puissance, $PV) {
        parent::__construct($nom, $puissance, $PV);
    }
    public $round;
}


//On dois ensuite afficher le nom des heros a choisir et les villain a combattre ainsi que leur stats
function afficherPersonnages($personnages) {
    foreach ($personnages as $key => $personnage) {
        echo ($key + 1) . ". " . $personnage->getNom() . " (PV: " . $personnage->PV . ", " . "Puissance:" . $personnage->puissance . ")\n";
    }
}

// Création de array des héros
$heros = [];

echo "Bienvenue dans dragon ball mega super. Choisissez votre personnage:\n\n";
echo "1. Goku\n";
echo "2. Vegeta\n";
echo "3. Yamcha\n";
echo "4. Gohan\n";
echo "5. Piccolo\n";

//création array des méchants
$mechants = [];

// Création de 5 méchants
$mechants[] = new Villain("C18", 40, 120);
$mechants[] = new Villain("C17", 50, 140);
$mechants[] = new Villain("Buu", 60, 160);
$mechants[] = new Villain("Cell", 70, 180);
$mechants[] = new Villain("Freezer", 80, 200);

// Sélection du héros, On dois choisir le hero que nous prennns en tapant le chiffre qui correspond grace au readline
while (true) {
    $choixHero = readline("\nEntrez le numéro de votre héros: ");
//un switch-case pour les differents heros 
    switch ($choixHero) {
        case '1': {
            $heros[] = new Hero("Goku", 100, 250);
            $heroChoisi = $heros[count($heros) - 1];
            echo "\nVous avez choisi " . $heroChoisi->getNom() . ".\n";
            break 2;
        }
        case '2': {
            $heros[] = new Hero("Vegeta", 90, 200);
            $heroChoisi = $heros[count($heros) - 1];
            echo "\nVous avez choisi " . $heroChoisi->getNom() . ".\n";
            break 2;
        }
        case '3': {
            $heros[] = new Hero("Yamcha", 80, 180);
            $heroChoisi = $heros[count($heros) - 1];
            echo "\nVous avez choisi " . $heroChoisi->getNom() . ".\n";
            break 2;
        }
        case '4': {
            $heros[] = new Hero("Gohan", 70, 160);
            $heroChoisi = $heros[count($heros) - 1];
            echo "\nVous avez choisi " . $heroChoisi->getNom() . ".\n";
            break 2;
        }
        case '5': {
            $heros[] = new Hero("Piccolo", 60, 140);
            $heroChoisi = $heros[count($heros) - 1];
            echo "\nVous avez choisi " . $heroChoisi->getNom() . ".\n";
            break 2;
        }
        default: {
            echo "Veuillez entrer un numéro valide.\n";
            break;
        }
    }
}


//un essai de pouvoir special malheuresement raté
function attaque_speciale($heros)
    {
        echo "vous avez debloqué une attaque speciale\n\n";
        $heros[1] *= 2;
    }
//On creer une boucle while pour que les enemis enchaine dés que un autre avant lui et mort.
//dans le cas du premier ce sera juste apres que le joueur ait selectionner sont adversaire.
$round = 0;
while (!empty($mechants) && $heroChoisi->estVivant()) {
    $mechantCible = $mechants[$round % count($mechants)];
    $heroChoisi->attaquer($mechantCible);
//Si les mechant meurt on passe directement a l'autre et on supprime le mort
    if (!$mechantCible->estVivant()) {
        unset($mechants[array_search($mechantCible, $mechants)]);
        attaque_speciale($heroChoisi);
        $round++;
    }
//Et si le heros prend des degats le tour passe au joueurs 
    $heroChoisi->prendreDesDegats($mechantCible->puissance);

    if (!$heroChoisi->estVivant()) {
        break;
    }
}
//les message de fin de partie qui dans les cas differents afficheront des messages differents
if (empty($mechants)) {
    echo "Vous avez vaincu tous les Villains\n";
} else {
    echo "Vous avez été vaincu\n";
}
?>