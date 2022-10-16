<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Ajout séance</title>
    <link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h2>Ajout séance</h2>
    <?php

    $dateAjd = date("Y\-m\-d");

    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    //la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8


    $query = "SELECT * FROM themes WHERE supprime=0";
    //echo $query;

    $result = mysqli_query($connect, $query);
    // $query utilise comme parametre de mysqli_query
    // mysqli_query($connect, $query);
    if (!$result)
    {
      echo "<br>pas bon  ".mysqli_error($connect);
    }

    echo "<FORM METHOD='POST' ACTION='ajouter_seance.php' >";
    echo "<table>";

    echo "<tr>";
    echo "<td>";
    echo "Veuillez choisir une date pour la séance :";
    echo "</td>";
    echo "<td>";
    echo "<input type='date' name='date' min=$dateAjd required='required'/>";
    echo "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>";
    echo "</br> Effectif Max :";
    echo "</td>";
    echo "<td>";
    echo "<input type = 'number' name='effmax' min='0' required='required'/>";
    echo "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "</br>";
    echo "<td>";
    echo "sélectionnez un thème : ";
    echo "</td>";


    echo "<td>";
    echo "<select name='theme' size='4' required='required'>";
    $index = 0;
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
      if ($row[2] == 0) {
        if ($index == 0) {
          echo "<option value='$row[0]' selected>";
          echo "$row[1]";
          echo "</option>";
          echo "</br>";
          $index = 1;
        } else {
          echo "<option value='$row[0]'>";
          echo "$row[1]";
          echo "</option>";
          echo "</br>";
        }
      }
    }
    echo "</select>";
    echo "</td>";
    echo "<br>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>";
    echo "<INPUT type='submit' value='Enregistrer séance' class='button'>";
    echo "</td>";
    echo "</tr>";
    echo "<br>";
    echo "</FORM>";

    mysqli_close($connect);

    ?>

  </body>
</html>
