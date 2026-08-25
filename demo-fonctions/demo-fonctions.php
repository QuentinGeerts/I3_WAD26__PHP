<?php

/*
  Démonstration - Les fonctions
*/

// 1.  Anatomie d'une fonction

// Fonction = retourne une valeur
function addition (float $nb1, float $nb2): float {
  return $nb1 + $nb2;
}

// Procédure = ne retourne pas de valeur
function afficher_message (string $message): void {
  //
}


// 2.  Fonction vs méthode vs closure

// 2.1.  Fonction (contexte: global)
// cfr. exemple précédent

// 2.2.  Méthode (contexte: classe [$this])
class Calculatrice {
  public float $nb1;
  public float $nb2;

  public function addition() {
    return $this->nb1 + $this->nb2;
  }
}

// 2.3.  Closure (contexte: variable => transportable)
$additionner = fn(float $a, float $b): float => $a + $b;


// 3.  Appel de fonctions / méthodes / closure

// 3.1. Fonction
$resultat = addition(5, 3);

echo "Résultat fonction: $resultat <br>";

// 3.2. Méthodes
$calculatrice = new Calculatrice();
$calculatrice->nb1 = 5;
$calculatrice->nb2 = 3;
$resultat = $calculatrice->addition();
echo "Résultat méthode: $resultat <br>";

// 3.3. Closure
$resultat = $additionner(5, 3);
echo "Résultat closure: $resultat <br>";


// 4.  Paramètres par défaut
// REGLE : Les paramètres optionnels sont toujours après les paramètres obligatoires
function creerUtilisateur (string $nom, string $role = 'user', bool $actif = false) {
  return compact('nom', 'role', 'actif');
}

$personne1 = creerUtilisateur('Geerts', 'admin', true);
$personne2 = creerUtilisateur('Person');

$personnes = [$personne1, $personne2];

foreach ($personnes as $key => $p) {
  print_r($p);

  echo "Personne.nom: " . $p["nom"] . "<br>";
  echo "Personne.role: " . $p["role"] . "<br>";
  echo "Personne.actif: " . $p["actif"] . "<br>";
}

// 5.  Arguments nommés

$personne3 = creerUtilisateur('Morre', actif: true);

$personne4 = creerUtilisateur(actif: true, nom: "Albert", role: 'admin');