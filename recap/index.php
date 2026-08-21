<?php

// Déclaration d'une variable
$prenom = "Quentin";
$age = 30;
$taille = 1.80;
$aPermis = true;

// Opérateur ternaire : condition ? valeur_si_vrai : valeur_si_faux
// $pseudo = isset($_GET["pseudo-name"]) ? htmlspecialchars($_GET["pseudo-name"]) : "";
// $password = isset($_GET["password"]) ? htmlspecialchars($_GET["password"]) : "";

// $pseudo = isset($_POST["pseudo-name"]) ? htmlspecialchars($_POST["pseudo-name"]) : "";
// $password = isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : "";

$pseudo = isset($_REQUEST["pseudo-name"]) ? htmlspecialchars($_REQUEST["pseudo-name"]) : "";
$password = isset($_REQUEST["password"]) ? htmlspecialchars($_REQUEST["password"]) : "";

// Déclaration de constantes

// 1.  mot-clef "const" (fonctionne dans les classes et en dehors)
const MA_CONSTANTE = "hello";

// 2.  méthode define(nom, valeur) (fonctionne uniquement en dehors d'une classe)
define('PI', 3.141592);

// PI = 3.14; // Pas possible
// MA_CONSTANTE = "Coucou"; // Pas possible

// Récupération des valeurs d'un formulaire

var_dump($_GET);
print_r($_POST);
print_r($_REQUEST); // Gère à la fois les get et post

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Hello les WAD26 !</h1>
  <?php

  echo "<p>J'espère que vous avez passé de bonnes vacances !</p>";

  ?>

  <?= "<p>Ceci est affiché au travers d'un raccourci</p>" ?>

  <?php

  echo "<p>Tu t'appelles " . $prenom . "</p>"; // Opérateur de concaténation
  echo "<p>Tu as $age ans.</p>"; // Interpolation de chaînes de caractères

  echo "<p>Pseudo: $pseudo / Mot de passe: $password</p>";

  ?>

  <!-- method: Type d'envoi -->
  <!-- action: Page cible de l'envoi -->
  <h2>Formulaire GET :</h2>
  <form action="." method="get">

    <label for="pseudo-id">Pseudo:</label>
    <input type="text" name="pseudo-name" id="pseudo-id">

    <label for="password">Mot de passe:</label>
    <input type="password" name="password" id="password">

    <button>Se connecter</button>

  </form>

  <h2>Formulaire POST :</h2>
  <form action="." method="post">

    <label for="pseudo-id">Pseudo:</label>
    <input type="text" name="pseudo-name" id="pseudo-id">

    <label for="password">Mot de passe:</label>
    <input type="password" name="password" id="password">

    <button>Se connecter</button>

  </form>

  <hr>

  <h2>Opérateurs :</h2>
  <form action="." method="post">

    <label for="nb1">Nombre 1:</label>
    <input type="number" name="nb1" id="nb1" value="<?= $_REQUEST["nb1"] ?>">

    <label for="nb2">Nombre 2:</label>
    <input type="number" name="nb2" id="nb2" value="<?= $_REQUEST["nb2"] ?>">

    <button>Tester</button>

  </form>

  <div>
    
    <?php
    
    $nb1 = isset($_REQUEST["nb1"]) ? $_REQUEST["nb1"] : 0;
    $nb2 = isset($_REQUEST["nb2"]) ? $_REQUEST["nb2"] : 0;
    
    $nb1Float = floatval($nb1);
    $nb2Int = intval($nb2);

    ?>
    
    <p>Nombre 1: <?= $nb1 ?> | <?= gettype($nb1) ?></p>
    <p>Nombre 2: <?= $nb2 ?> | <?= gettype($nb2) ?></p>
    <p>Somme: <?= $nb1 + $nb2 ?></p>

    <p>Nombre 1 (converti): <?= $nb1Float ?> | <?= gettype($nb1Float) ?></p>
    <p>Nombre 2 (converti): <?= $nb2Int ?> | <?= gettype($nb2Int) ?></p>

    <h2>Comparaison: </h2>
    <p>5 == "5": <?= 5 == "5" ?></p>
    <p>5 === "5": <?= 5 === "5" ?></p>


    <h3>Logique:</h3>

    <p>true && true: <?= true && true ?></p>
    <p>true && false: <?= true && false ?></p>
    <p>false && false: <?= false && false ?></p>

    <p>true || true: <?= true || true ?></p>
    <p>true || false: <?= true || false ?></p>
    <p>false || false: <?= false || false ?></p>

    <p>!true: <?= !true ?></p>
    <p>!false: <?= !false ?></p>
  </div>

  <div>
    <h2>Structures conditionnelles :</h2>

    <?php
    
    if (true) {
      echo "<p>Coucou</p>";
    }

    if (false) {
      // Ceci ne sera pas exécuté
    }
    else {
      // Ceci sera exécuté
    }


    if (false) {
      // Ceci ne sera pas exécuté
    }
    else if (true) {
      // Ceci sera exécuté
    }
    else {
      // Ceci ne sera pas exécuté
    }
    

    // switch (expression) {
    //   case valeur:
    //     // block d'instructions
    //     break;
    //   case valeur:
    //     // block d'instructions
    //     break;
    //   case valeur:
    //   case valeur:
    //     // block d'instructions
    //     break;
    //   default:
    //     // block d'instructions
    //     break;
    //}

    ?>
  </div>

  <div>
    <h2>Structures itératives</h2>

    <?php
    
    // while (expression_booléenne) {
    //   // Bloc d'instructions
    // }

    echo "<ul>";
    // initialisation ; condition d'arrêt ; incrémentation
    for ($i = 1; $i <= 10; $i++) { 
      echo "<li>$i * 2 = " . $i * 2 . "</li>";
    }
    echo "</ul>";

    ?>

  </div>

</body>

</html>