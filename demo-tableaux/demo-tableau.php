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

// Récupérer le nombre d'éléments dans un tableau
echo "Jours: " . count($jours) . "<br>"; // 31
echo "Dinner: " . count($dinner) . "<br>"; // 5

// Vérifier si une valeur est dans le tableau
echo "Frite dans le tableau : " . in_array("frite", $dinner) . "<br>"; // false
echo "Salade dans le tableau : " . in_array("salade", $dinner) . "<br>"; // true

// Vérifier si la clef est dans le tableau
echo "samedi est dans le tableau: " . array_key_exists("samedi", $dinner) . "<br>";
echo "lundi est dans le tableau: " . array_key_exists("lundi", $dinner) . "<br>";

// Obtenir la liste des clefs / valeurs

echo "Clefs: " . print_r(array_keys($dinner)) . "<br>";
echo "Clefs: " . print_r(array_values($dinner)) . "<br>";

// Ajouter ou retirer une valeur du tableau (dynamique)

$tab1 = [1, 2, 3, 4, 5];

// a. Ajouter à la fin
array_push($tab1, 6, 7); // [1, 2, 3, 4, 5, 6, 7]

// b. Retirer de la fin (1 seul)
$removed_item = array_pop($tab1); // [1, 2, 3, 4, 5, 6] | removed_item: 7

// c. Ajouter au début
array_unshift($tab1, -1, 0); // [-1, 0, 1, 2, 3, 4, 5, 6]

// d. Retirer au début
$removed_item = array_shift($tab1); // [0, 1, 2, 3, 4, 5, 6] | removed_item: -1

// JS: array.map((v) => v + 10)

// Retourer un tableau transformé

$transformed_array = array_map(fn($v) => $v + 10, $tab1);

// Transformer un tableau en une chaine de caractères (JS: Array.prototype.join())

echo "Tableau: " . implode(", ", $transformed_array) . "<br>";

// Transformer une chaine de caractères en tableau (JS: String.prototype.split())

print_r(explode(", ", "10, 11, 12, 13, 14, 15, 16"));

// Filtrer un tableau
// JS: Array.prototype.filter(callback)
// myArray.filter(v => v % 2 == 0)

$filtered_array = array_filter($tab1, fn($v) => $v % 2 == 0);
print_r($filtered_array);

// Somme / Différence

$somme = array_sum($tab1);
$diff = array_diff($tab1);

// Min / max

$min = min($tab1);
$max = max($tab1);


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