<?php

/*
  Exercice 01 - Tableau aléatoire
  Créer une page qui permet d'afficher 50 entiers calculés aléatoirement et afficher dans un tableau.
*/

$tab = [];

for ($i = 0; $i < 50; $i++) {
  $tab[$i] = rand(1, 100);
}

print_r($tab);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

  <?php foreach($tab as $value) : ?>
  <p><?= $value ?></p>    
  <?php endforeach; ?>
  
</body>
</html>