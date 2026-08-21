<?php

// Déclaration d'une variable
$prenom = "Quentin";
$age = 30;
$taille = 1.80;
$aPermis = true;

// Déclaration de constantes

// 1.  mot-clef "const" (fonctionne dans les classes et en dehors)
const MA_CONSTANTE = "hello";

// 2.  méthode define(nom, valeur) (fonctionne uniquement en dehors d'une classe)
define('PI', 3.141592);

// PI = 3.14; // Pas possible
// MA_CONSTANTE = "Coucou"; // Pas possible

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
  echo "<p>Tu as $age ans.</p>" // Interpolation de chaînes de caractères

  
  ?>
</body>

</html>