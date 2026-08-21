<?php

/*
  Démonstration - Tableau
*/

// 1.  Déclaration

// 1.1.  Avec le constructeur
$tab1 = array();
$tab2 = array(5, 9, 4);
$tab3 = array(42, "Quentin", true, array());

var_dump($tab1);
echo "<br>";
var_dump($tab2);
echo "<br>";
var_dump($tab3);
echo "<br>";

// 1.2.  À la volée
$tab4 = [];
$tab5 = [42, "Quentin", true, []];

// 2.  Récupération d'une donnée dans le tableau

echo "<p> " . $tab3[1] . " </p>";
echo "<p> " . $tab3[-3] . " </p>"; // Index inconnue

$tab3[-3] = 42;

echo "<p> " . $tab3[-3] . " </p>"; // Index connue

// 3.  Initialisation d'un tableau avec une boucle

$jours = [];

for ($jour = 1; $jour <= 31; $jour++) {
  $jours[$jour] = rand(28, 38);
}

$dinner = [];

// Tableau associatif
$dinner["lundi"] = "sandwich";
$dinner["mardi"] = "sandwich";
$dinner["mercredi"] = "sandwich";
$dinner["jeudi"] = "salade";
$dinner["vendredi"] = "sandwich";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <table>
    <thead>
      <tr>
        <th>Jour</th>
        <th>Température</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($jours as $index => $temperature) : ?>

        <tr>
          <td><?= $index ?></td>
          <td><?= $temperature ?></td>
        </tr>

      <?php endforeach ?>

    </tbody>
  </table>

  <h2>Repas de la semaine :</h2>

  <ul>
    <?php foreach ($dinner as $jour => $repas) : ?>
      <li><?= $jour ?> : <?= $repas ?></li>
    <?php endforeach ?>
  </ul>

  <ul>
    <?php

    foreach ($dinner as $jour => $repas) {
      // echo "<li>" . $jour . " : " . $repas . "</li>";
      echo "<li>$jour : $repas</li>";
    }

    ?>
  </ul>


</body>

</html>