<?php

/*
  ## Exercice 02 - Recherche tableau

  Réalisez une fonction de recherche dans un tableau. Cette fonction va recevoir un tableau et la valeur recherchée en paramètres et renvoyer l'indice de l'élément dans le tableau. Si l'élément ne s'y trouve pas, la fonction renvoie -1. Le tableau doit être initialisé au début de votre programme.
*/

function indexOf(array $a, mixed $searched_value): int
{
  foreach ($a as $index => $value) {
    if ($value === $searched_value) return $index;
  }
  return -1;
}

$message = null;
$array = [42, "Quentin", true, 1.2, "Quentin"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <h1>Exercice 02 - Recherche tableau</h1>

  <div>
    <?php

    echo "Quentin: " . indexOf($array, "Quentin") . "<br>"; // 1
    echo "1.2: " . indexOf($array, 1.2) . "<br>"; // 3
    echo "coucou: " . indexOf($array, "coucou") . "<br>"; // -1

    ?>
  </div>

</body>

</html>