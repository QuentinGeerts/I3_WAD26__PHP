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
12. [Fonctions utiles rencontrées](#12-fonctions-utiles-rencontrées)

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

📄 Voir [demo-tableaux/index.php](demo-tableaux/index.php) et [demo-tableaux/exercices/exercice01.php](demo-tableaux/exercices/exercice01.php)

---

## 12. Fonctions utiles rencontrées

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

---

## Structure du dépôt

```
.
├── recap/                       → Récapitulatif général (variables, formulaires, opérateurs, conditions, boucles)
├── demo-tableaux/                → Démonstration sur les tableaux et foreach
│   └── exercices/                → Énoncés et corrections d'exercices sur les tableaux
└── notes/                        → Notes diverses (ex. configuration de VS Code)
```
