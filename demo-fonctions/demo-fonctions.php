<?php

/*
  Démonstration - Les fonctions
*/

// 1.  Anatomie d'une fonction

// Fonction = retourne une valeur
function addition(float $nb1, float $nb2): float
{
  return $nb1 + $nb2;
}

// Procédure = ne retourne pas de valeur
function afficher_message(string $message): void
{
  //
}


// 2.  Fonction vs méthode vs closure

// 2.1.  Fonction (contexte: global)
// cfr. exemple précédent

// 2.2.  Méthode (contexte: classe [$this])
class Calculatrice
{
  public float $nb1;
  public float $nb2;

  public function addition()
  {
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
function creerUtilisateur(string $nom, string $role = 'user', bool $actif = false)
{
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

// 6.  Passage par valeur vs référence

class Voiture
{
  public string $couleur;
}

function passageParValeur(int $a): void
{
  echo "<p>[passageParValeur] a: $a</p>"; // 5
  $a++;
  echo "<p>[passageParValeur] a: $a</p>"; // 6
}

// ⚠️ pour passer les tableaux par référence, utilisez l'opérateur de référence: &
function passageParReferenceTableau(array &$tab): void
{
  echo "<p>[passageParReferenceTableau] tab: " . implode(", ", $tab) . "</p>"; // 0
  $tab[0] = 42;
  echo "<p>[passageParReferenceTableau] tab: " . implode(", ", $tab) . "</p>"; // 42
}

function passageParReferenceObjet(Voiture $voiture)
{
  echo "<p>[passageParReferenceObjet] voiture couleur: " . $voiture->couleur . "</p>"; // rouge
  $voiture->couleur = "blanc";
  echo "<p>[passageParReferenceObjet] voiture couleur: " . $voiture->couleur . "</p>"; // blanc
}

$nb = 5;

echo "<p>[main] nb: $nb</p>"; // 5
passageParValeur($nb);
echo "<p>[main] nb: $nb</p>"; // 5

$t = [0];

echo "<p>[main] t: " . $t[0] . " </p>"; // 0
passageParReferenceTableau($t);
echo "<p>[main] t: " . $t[0] . " </p>"; // 42

$v = new Voiture();
$v->couleur = "rouge";

echo "<p>[main] voiture couleur: " . $v->couleur . "</p>"; // rouge
passageParReferenceObjet($v);
echo "<p>[main] voiture couleur: " . $v->couleur . "</p>"; // blanc


// 7.  Fonction variadique (...) (fonction avec un nombre indéfini de paramètres)

function somme(float $default = 0, float ...$valeurs): float
{
  return array_sum($valeurs) + $default;
}

$resultat = somme(1, 2, 3); // 6
$resultat = somme(); // 0

// 8.  Spread operator (...)

$t2 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

$t3 = [0, $t2]; // ⚠️ Un tableau qui contient un tableau
$t4 = [0, ...$t2];

$t2_copy = [...$t2];

$t_somme = somme(0, ...$t2);

// 9.  Destructuration

[$valeur1, $valeur2, /* valeur3 ignorée */, $valeur4] = $t2;

$valeur1 = $t2[0];

echo "<p>valeur1: $valeur1</p>";
echo "<p>valeur2: $valeur2</p>";
echo "<p>valeur4: $valeur4</p>";

$personne = [
  "nom" => "Geerts",
  "prenom" => "Quentin",
  "date-naissance" => "1996-04-03",
];

['nom' => $nom, 'prenom' => $prenom, 'date-naissance' => $date_naissance] = $personne;

echo "<p>Tu t'appelles $nom $prenom, né le $date_naissance</p>";


// 10.  Retour de type nullable

class Personne
{
  public int $id;
  public string $prenom;

  public function __construct(int $id, string $prenom)
  {
    $this->id = $id;
    $this->prenom = $prenom;
  }
}

$personnes = [
  new Personne(1, "Quentin"),
  new Personne(2, "Marie"),
  new Personne(3, "Lucas"),
  new Personne(4, "Emma"),
  new Personne(5, "Nathan"),
  new Personne(6, "Chloé"),
  new Personne(7, "Hugo"),
  new Personne(8, "Léa"),
  new Personne(9, "Louis"),
  new Personne(10, "Sarah"),
];

/**
 * @param Personne[] $personnes Le tableau de personnes sur lequel on recherche
 */
function rechercheParId(array $personnes, int $id): Personne | null
{
  foreach ($personnes as $p) {
    if ($p->id == $id) return $p;
  }
  return null;
}

$searched_person = rechercheParId($personnes, 1);
print_r($searched_person);

$searched_person = rechercheParId($personnes, 11);
print_r($searched_person);


// 11.  Callback

function hasFirstLetter(Personne $personne): bool
{
  return strtolower($personne->prenom[0]) == 'l';
}

function hasEvenId(Personne $personne): bool
{
  return $personne->id % 2 == 0;
}

function custom_filter(array $array, callable $compareFn)
{
  $filtered = [];

  foreach ($array as $element) {
    if ($compareFn($element)) {
      array_push($filtered, $element);
    }
  }

  return $filtered;
}

echo "<br>";

echo "<h2>Id pair:</h2>";
foreach (custom_filter($personnes, 'hasEvenId') as $p) {
  $id = $p->id;
  $prenom = $p->prenom;
  echo "<li>$id: $prenom</li>";
}

echo "<h2>Commence par L:</h2>";
foreach (custom_filter($personnes, 'hasFirstLetter') as $p) {
  $id = $p->id;
  $prenom = $p->prenom;
  echo "<li>$id: $prenom</li>";
}

echo "<h2>Commence par Q:</h2>";
foreach (
  custom_filter($personnes, function (Personne $p) {
    return strtolower($p->prenom[0]) == "q";
  }) as $p
) {
  $id = $p->id;
  $prenom = $p->prenom;
  echo "<li>$id: $prenom</li>";
}

echo "<h2>Commence par E:</h2>";
foreach (
  custom_filter($personnes, fn(Personne $p) => strtolower($p->prenom[0]) == "e")
  as $p
) {
  $id = $p->id;
  $prenom = $p->prenom;
  echo "<li>$id: $prenom</li>";
}
