<?php

/*
  Exercice 01 - Carré

  Réalisez une fonction calculant le carré d'un nombre entier donné en paramètres. La valeur doit être récupérée depuis un formulaire.
*/

// Déclaration de la fonction
function square(int $nb): int
{
  return $nb ** 2;
}


// Logique
$number = 0;
$error_message = null;

if (isset($_REQUEST["number"])) {
  if (is_numeric($_REQUEST["number"])) {
    // Récupération de la valeur du formulaire
    $number = $_REQUEST["number"];

    // Appeler la fonction square
    $result = square($number);
  } else {
    $error_message = "Veuillez entrer un nombre entier.";
  }
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

  <h1>Fonctions - Exercice 01 - Carré</h1>

  <form action="exercice01.php" method="post">

    <?php if (isset($error_message)): ?>
      <div class="error">
        <p><?= $error_message ?></p>
      </div>
    <?php endif ?>

    <label for="number">Nombre:</label>
    <input type="number" name="number" id="number">

    <button>Calculer</button>

  </form>

  <?php if (isset($result)) : ?>
    <div class="result">
      <p>Résultat: <?= $result ?></p>
    </div>
  <?php endif ?>
</body>

</html>