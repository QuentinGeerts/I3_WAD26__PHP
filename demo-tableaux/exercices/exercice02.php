<?php

/*
  Exercice 02 - Puissance 2

  Initialiser un tableau de 10 entiers avec les valeurs 2, 4, 8, 16, 32, ... 1024 (⚠️ les valeurs doivent être calculées automatiquement !).

  Ensuite afficher les valeurs sous formes de liste.
*/

// Déclaration du tableau
$tab = [];

// Initialisation du tableau
// initialisation ; condition ; incrémentation
for ($i = 1; $i <= 10; $i++) {
  $tab[$i] = 2 ** $i;
  // $tab[$i] = pow(2, $i);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <h1>Puissance de 2 :</h1>

  <ul>
    <?php foreach ($tab as $value): ?>
    <li><?= $value ?></li>
    <?php endforeach ?>
  </ul>

</body>

</html>