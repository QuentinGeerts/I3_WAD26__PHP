# I3 WAD26 — PHP : Synthèse théorique

Ce README reprend, sous forme de synthèse pédagogique, l'ensemble de la théorie PHP vue en cours jusqu'à présent. Chaque section renvoie vers les fichiers de démonstration correspondants du dépôt.

## Sommaire

1. [Balises PHP et intégration au HTML](#1-balises-php-et-intégration-au-html)
2. [Variables et types](#2-variables-et-types)
3. [Constantes](#3-constantes)
4. [Concaténation et interpolation de chaînes](#4-concaténation-et-interpolation-de-chaînes)
5. [Récupération des données de formulaire](#5-récupération-des-données-de-formulaire)
6. [Conversion de types](#6-conversion-de-types)
7. [Opérateurs de comparaison](#7-opérateurs-de-comparaison)
8. [Opérateurs logiques](#8-opérateurs-logiques)
9. [Structures conditionnelles](#9-structures-conditionnelles)
10. [Structures itératives](#10-structures-itératives)
11. [Les tableaux](#11-les-tableaux)
12. [Les fonctions](#12-les-fonctions)
13. [Fonctions utiles rencontrées](#13-fonctions-utiles-rencontrées)

---

## 1. Balises PHP et intégration au HTML

PHP s'intercale dans du HTML classique grâce aux balises `<?php ... ?>`. Il existe un raccourci pour afficher directement une valeur : `<?= ... ?>`, équivalent à `<?php echo ... ?>`.

```php
<?php
echo "<p>Affiché via echo</p>";
?>

<?= "<p>Affiché via le raccourci d'affichage</p>" ?>
```

📄 Voir [recap/index.php](recap/index.php)

---

## 2. Variables et types

Une variable PHP se déclare avec le préfixe `$`, sans typage explicite (typage dynamique).

```php
$prenom = "Quentin";   // string
$age = 30;              // int
$taille = 1.80;         // float
$aPermis = true;        // bool
```

On peut connaître le type d'une variable avec `gettype()` et inspecter son contenu avec `var_dump()` (type + valeur) ou `print_r()` (valeur, plus lisible pour les tableaux).

---

## 3. Constantes

Deux façons de déclarer une constante en PHP :

| Méthode | Syntaxe | Portée |
|---|---|---|
| Mot-clé `const` | `const MA_CONSTANTE = "hello";` | Fonctionne dans les classes et en dehors |
| Fonction `define()` | `define('PI', 3.141592);` | Fonctionne uniquement en dehors d'une classe |

Une constante, une fois définie, ne peut plus être réassignée (`PI = 3.14;` provoque une erreur).

---

## 4. Concaténation et interpolation de chaînes

- **Concaténation** : opérateur `.`
  ```php
  echo "<p>Tu t'appelles " . $prenom . "</p>";
  ```
- **Interpolation** : une variable insérée directement dans une chaîne entre guillemets doubles `"..."` est automatiquement remplacée par sa valeur (ne fonctionne pas avec des guillemets simples `'...'`).
  ```php
  echo "<p>Tu as $age ans.</p>";
  ```

---

## 5. Récupération des données de formulaire

Un formulaire HTML envoie ses données selon la méthode précisée dans l'attribut `method` :

- `method="get"` → les données sont dans l'URL, récupérables via **`$_GET`**
- `method="post"` → les données sont dans le corps de la requête, récupérables via **`$_POST`**
- **`$_REQUEST`** → regroupe GET et POST (et les cookies), pratique pour ne pas se soucier de la méthode utilisée

```php
$pseudo = isset($_REQUEST["pseudo-name"]) ? htmlspecialchars($_REQUEST["pseudo-name"]) : "";
```

Points clés :

- **`isset()`** vérifie qu'une variable/clé existe et n'est pas `null`, avant de l'utiliser (évite les erreurs si le formulaire n'a pas encore été soumis).
- **`htmlspecialchars()`** échappe les caractères spéciaux HTML (`<`, `>`, `"`, ...) pour se prémunir des failles XSS lors de l'affichage d'une donnée utilisateur.
- **Opérateur ternaire** : `condition ? valeur_si_vrai : valeur_si_faux` — raccourci pour un `if/else` qui retourne une valeur.

Attributs importants d'un `<form>` :

- `method` : type d'envoi (`get` ou `post`)
- `action` : page cible de l'envoi (`.` = la page courante)

📄 Voir [recap/index.php](recap/index.php)

---

## 6. Conversion de types

Les données issues d'un formulaire arrivent toujours sous forme de **chaînes de caractères**. Pour les manipuler comme des nombres, on les convertit :

```php
$nb1Float = floatval($nb1); // conversion en nombre décimal
$nb2Int   = intval($nb2);   // conversion en nombre entier
```

---

## 7. Opérateurs de comparaison

| Opérateur | Nom | Comportement |
|---|---|---|
| `==` | Égalité "souple" | Compare les valeurs après conversion de type (`5 == "5"` → `true`) |
| `===` | Égalité stricte | Compare valeur **et** type (`5 === "5"` → `false`) |

⚠️ Toujours préférer `===` pour éviter les conversions de type implicites surprenantes.

---

## 8. Opérateurs logiques

| Opérateur | Signification | Exemple |
|---|---|---|
| `&&` | ET logique | `true && false` → `false` |
| `\|\|` | OU logique | `true \|\| false` → `true` |
| `!` | NON logique (négation) | `!true` → `false` |

---

## 9. Structures conditionnelles

### if / else if / else

```php
if (true) {
  // exécuté
} else if (false) {
  // sinon, si...
} else {
  // sinon
}
```

### switch

```php
switch ($expression) {
  case valeur1:
    // bloc d'instructions
    break;
  case valeur2:
  case valeur3:
    // plusieurs cas peuvent partager le même bloc (fallthrough)
    break;
  default:
    // exécuté si aucun cas ne correspond
    break;
}
```

⚠️ Ne pas oublier le `break;` sous peine d'exécuter aussi les blocs `case` suivants.

---

## 10. Structures itératives

### while

```php
while (expression_booléenne) {
  // bloc d'instructions, tant que la condition est vraie
}
```

### for

```php
// initialisation ; condition d'arrêt ; incrémentation
for ($i = 1; $i <= 10; $i++) {
  echo "<li>$i * 2 = " . $i * 2 . "</li>";
}
```

### foreach

Boucle dédiée au parcours des tableaux (voir section suivante).

📄 Voir [recap/index.php](recap/index.php)

---

## 11. Les tableaux

### 11.1. Déclaration

Deux syntaxes équivalentes :

```php
// Avec le constructeur array()
$tab1 = array();
$tab2 = array(5, 9, 4);
$tab3 = array(42, "Quentin", true, array()); // tableaux imbriqués possibles

// À la volée, avec des crochets []
$tab4 = [];
$tab5 = [42, "Quentin", true, []];
```

### 11.2. Tableaux indexés

Les éléments sont accessibles via un **index numérique**, qui commence à `0` par défaut.

```php
echo $tab3[1]; // "Quentin"
```

⚠️ Accéder à un index qui n'existe pas encore génère un avertissement — on peut néanmoins **créer** cet index en lui assignant une valeur :

```php
$tab3[-3] = 42; // crée l'index -3
```

### 11.3. Tableaux associatifs

Les éléments sont accessibles via une **clé** (chaîne de caractères) plutôt qu'un index numérique.

```php
$dinner = [];
$dinner["lundi"]    = "sandwich";
$dinner["mardi"]    = "sandwich";
$dinner["mercredi"] = "sandwich";
$dinner["jeudi"]    = "salade";
$dinner["vendredi"] = "sandwich";
```

### 11.4. Initialiser un tableau avec une boucle

```php
$jours = [];
for ($jour = 1; $jour <= 31; $jour++) {
  $jours[$jour] = rand(28, 38);
}
```

### 11.5. Parcourir un tableau avec foreach

Syntaxe classique :

```php
foreach ($dinner as $jour => $repas) {
  echo "<li>$jour : $repas</li>";
}
```

Syntaxe alternative, plus lisible lorsqu'on mélange PHP et HTML (notamment dans les boucles/conditions à cheval sur du balisage) :

```php
<?php foreach ($jours as $index => $temperature) : ?>
  <tr>
    <td><?= $index ?></td>
    <td><?= $temperature ?></td>
  </tr>
<?php endforeach ?>
```

Si on ne s'intéresse qu'aux valeurs (tableau indexé, sans besoin de la clé) :

```php
foreach ($tab as $value) {
  echo $value;
}
```

### 11.6. Informations sur un tableau

```php
count($jours);                          // nombre d'éléments : 31
in_array("salade", $dinner);            // la valeur existe-t-elle ? → true/false
array_key_exists("lundi", $dinner);     // la clé existe-t-elle ? → true/false

array_keys($dinner);                    // tableau des clés
array_values($dinner);                  // tableau des valeurs
```

### 11.7. Ajouter / retirer des éléments dynamiquement

| Fonction | Rôle |
|---|---|
| `array_push($tab, ...$valeurs)` | Ajoute un ou plusieurs éléments **à la fin** |
| `array_pop($tab)` | Retire et retourne le **dernier** élément |
| `array_unshift($tab, ...$valeurs)` | Ajoute un ou plusieurs éléments **au début** |
| `array_shift($tab)` | Retire et retourne le **premier** élément |

```php
$tab1 = [1, 2, 3, 4, 5];

array_push($tab1, 6, 7);        // [1, 2, 3, 4, 5, 6, 7]
$removed = array_pop($tab1);    // [1, 2, 3, 4, 5, 6] | $removed: 7

array_unshift($tab1, -1, 0);    // [-1, 0, 1, 2, 3, 4, 5, 6]
$removed = array_shift($tab1);  // [0, 1, 2, 3, 4, 5, 6] | $removed: -1
```

### 11.8. Transformer, filtrer et agréger un tableau

Équivalents des méthodes `map`, `filter`, `join`... de JavaScript :

```php
// Transformer chaque élément (≈ JS: array.map())
$transformed = array_map(fn($v) => $v + 10, $tab1);

// Tableau → chaîne de caractères (≈ JS: Array.prototype.join())
echo implode(", ", $transformed);

// Chaîne de caractères → tableau (≈ JS: String.prototype.split())
print_r(explode(", ", "10, 11, 12, 13, 14, 15, 16"));

// Filtrer selon une condition (≈ JS: array.filter())
$filtered = array_filter($tab1, fn($v) => $v % 2 == 0);

// Agrégations
$somme = array_sum($tab1);
$min = min($tab1);
$max = max($tab1);
```

📄 Voir [demo-tableaux/demo-tableau.php](demo-tableaux/demo-tableau.php), [demo-tableaux/exercices/exercice01.php](demo-tableaux/exercices/exercice01.php) et [demo-tableaux/exercices/exercice02.php](demo-tableaux/exercices/exercice02.php)

---

## 12. Les fonctions

### 12.1. Anatomie d'une fonction

```php
// Fonction : retourne une valeur
function addition(float $nb1, float $nb2): float
{
  return $nb1 + $nb2;
}

// Procédure : ne retourne pas de valeur (type de retour void)
function afficher_message(string $message): void
{
  // ...
}
```

On peut typer les paramètres et la valeur de retour (`float`, `string`, `void`, ...) — PHP vérifie alors ces types.

### 12.2. Fonction vs méthode vs closure

| Concept | Contexte | Exemple |
|---|---|---|
| **Fonction** | Global | `function addition($a, $b) { return $a + $b; }` |
| **Méthode** | Classe (accès à `$this`) | `public function addition() { return $this->nb1 + $this->nb2; } ` |
| **Closure (fonction fléchée)** | Stockée dans une variable → transportable | `$additionner = fn(float $a, float $b): float => $a + $b;` |

```php
$resultat = addition(5, 3);           // appel d'une fonction
$resultat = $calculatrice->addition(); // appel d'une méthode sur un objet
$resultat = $additionner(5, 3);        // appel d'une closure
```

### 12.3. Paramètres par défaut

```php
// RÈGLE : les paramètres optionnels sont toujours après les paramètres obligatoires
function creerUtilisateur(string $nom, string $role = 'user', bool $actif = false)
{
  return compact('nom', 'role', 'actif');
}

$personne1 = creerUtilisateur('Geerts', 'admin', true);
$personne2 = creerUtilisateur('Person'); // role et actif prennent leur valeur par défaut
```

`compact('nom', 'role', 'actif')` construit un tableau associatif à partir des variables locales du même nom (`["nom" => ..., "role" => ..., "actif" => ...]`).

### 12.4. Arguments nommés

On peut préciser le nom du paramètre lors de l'appel, ce qui permet de ne pas respecter l'ordre et de ne fournir que certains paramètres optionnels :

```php
$personne3 = creerUtilisateur('Morre', actif: true);
$personne4 = creerUtilisateur(actif: true, nom: "Albert", role: 'admin');
```

### 12.5. Passage par valeur vs par référence

Par défaut, PHP passe les **types simples** (int, float, string, bool) **par valeur** : une copie est transmise, les modifications dans la fonction ne touchent pas la variable d'origine.

```php
function passageParValeur(int $a): void
{
  $a++; // ne modifie que la copie locale
}

$nb = 5;
passageParValeur($nb);
// $nb vaut toujours 5
```

⚠️ Les **tableaux** sont eux aussi passés par valeur par défaut ; pour les passer **par référence**, on utilise l'opérateur `&` devant le paramètre :

```php
function passageParReferenceTableau(array &$tab): void
{
  $tab[0] = 42; // modifie directement le tableau d'origine
}
```

Les **objets**, en revanche, sont toujours manipulés via leur référence : modifier une propriété dans une fonction modifie bien l'objet d'origine, sans avoir besoin du `&`.

```php
function passageParReferenceObjet(Voiture $voiture): void
{
  $voiture->couleur = "blanc"; // modifie l'objet original
}
```

### 12.6. Fonction variadique (`...`)

Permet de recevoir un nombre indéfini d'arguments, regroupés dans un tableau :

```php
function somme(float $default = 0, float ...$valeurs): float
{
  return array_sum($valeurs) + $default;
}

somme(1, 2, 3); // 6
somme();        // 0
```

### 12.7. Spread operator (`...`)

Permet de « déplier » un tableau existant dans un autre tableau ou dans une liste d'arguments :

```php
$t2 = [1, 2, 3];

$t3 = [0, $t2];     // ⚠️ [0, [1, 2, 3]] → tableau qui contient un tableau
$t4 = [0, ...$t2];  // [0, 1, 2, 3]      → éléments dépliés

$t2_copy = [...$t2];       // copie du tableau
$t_somme = somme(0, ...$t2); // les éléments de $t2 deviennent des arguments séparés
```

### 12.8. Destructuration

Permet d'extraire plusieurs valeurs d'un tableau en une seule assignation.

Tableau indexé :

```php
[$valeur1, $valeur2, /* valeur3 ignorée */, $valeur4] = $t2;
```

Tableau associatif (les clés du tableau doivent correspondre) :

```php
$personne = [
  "nom" => "Geerts",
  "prenom" => "Quentin",
  "date-naissance" => "1996-04-03",
];

['nom' => $nom, 'prenom' => $prenom, 'date-naissance' => $date_naissance] = $personne;
```

### 12.9. Retour de type nullable

Une fonction qui peut soit retourner un objet, soit ne rien trouver, peut typer son retour avec `Type|null` :

```php
function rechercheParId(array $personnes, int $id): Personne|null
{
  foreach ($personnes as $p) {
    if ($p->id == $id) return $p;
  }
  return null;
}
```

### 12.10. Callback (fonction passée en paramètre)

Une fonction peut recevoir une autre fonction en paramètre (type `callable`), pour personnaliser son comportement — utile pour écrire ses propres fonctions génériques (ex. un `filter` maison) :

```php
function custom_filter(array $array, callable $compareFn): array
{
  $filtered = [];
  foreach ($array as $element) {
    if ($compareFn($element)) {
      array_push($filtered, $element);
    }
  }
  return $filtered;
}
```

Un callback peut être fourni sous plusieurs formes :

```php
// 1. Nom de fonction sous forme de chaîne
custom_filter($personnes, 'hasEvenId');

// 2. Fonction anonyme
custom_filter($personnes, function (Personne $p) {
  return strtolower($p->prenom[0]) == "q";
});

// 3. Fonction fléchée (arrow function), plus concise
custom_filter($personnes, fn(Personne $p) => strtolower($p->prenom[0]) == "e");
```

📄 Voir [demo-fonctions/demo-fonctions.php](demo-fonctions/demo-fonctions.php) et [demo-fonctions/exercices/exercices.md](demo-fonctions/exercices/exercices.md)

---

## 13. Fonctions utiles rencontrées

| Fonction | Rôle |
|---|---|
| `var_dump($var)` | Affiche le type **et** la valeur d'une variable (idéal pour déboguer) |
| `print_r($var)` | Affiche une valeur de façon lisible (utile pour les tableaux) |
| `gettype($var)` | Retourne le type d'une variable sous forme de chaîne |
| `isset($var)` | Vérifie qu'une variable existe et n'est pas `null` |
| `htmlspecialchars($str)` | Échappe les caractères spéciaux HTML (protection XSS) |
| `floatval($val)` | Convertit une valeur en nombre décimal (`float`) |
| `intval($val)` | Convertit une valeur en nombre entier (`int`) |
| `rand($min, $max)` | Génère un nombre entier aléatoire entre `$min` et `$max` |
| `pow($base, $exposant)` (ou `**`) | Élève un nombre à une puissance |
| `count($tab)` | Nombre d'éléments dans un tableau |
| `in_array($valeur, $tab)` | Vérifie si une valeur est présente dans un tableau |
| `array_key_exists($cle, $tab)` | Vérifie si une clé existe dans un tableau |
| `array_keys($tab)` / `array_values($tab)` | Retourne les clés / les valeurs d'un tableau |
| `array_push($tab, ...)` / `array_pop($tab)` | Ajoute / retire un élément en fin de tableau |
| `array_unshift($tab, ...)` / `array_shift($tab)` | Ajoute / retire un élément en début de tableau |
| `array_map($fn, $tab)` | Applique une fonction à chaque élément et retourne un nouveau tableau |
| `array_filter($tab, $fn)` | Retourne les éléments qui valident une condition |
| `array_sum($tab)` | Somme des éléments d'un tableau |
| `min($tab)` / `max($tab)` | Plus petite / plus grande valeur d'un tableau |
| `implode($separateur, $tab)` | Transforme un tableau en chaîne de caractères |
| `explode($separateur, $chaine)` | Transforme une chaîne de caractères en tableau |
| `compact(...$noms)` | Construit un tableau associatif à partir de variables locales |

---

## Structure du dépôt

```
.
├── recap/                       → Récapitulatif général (variables, formulaires, opérateurs, conditions, boucles)
├── demo-tableaux/                → Démonstration sur les tableaux et foreach
│   └── exercices/                → Énoncés et corrections d'exercices sur les tableaux
├── demo-fonctions/               → Démonstration sur les fonctions (paramètres, références, callbacks, ...)
│   └── exercices/                → Énoncés d'exercices sur les fonctions
└── notes/                        → Notes diverses (ex. configuration de VS Code)
```
