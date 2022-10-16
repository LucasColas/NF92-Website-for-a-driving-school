<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Suppression thème</title>
    <link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <?php
    echo "<h2>Suppression d'un thème</h2>";
    date_default_timezone_set('Europe/Paris');
    $dateAjd = date("Y\-m\-d");

    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    //la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8


    date_default_timezone_set('Europe/Paris');
    $dateAjd = date("Y\-m\-d");


    $query = "SELECT * FROM themes WHERE supprime = 0";
    //echo $query;
    $result = mysqli_query($connect, $query);

    if (!$result) {
        echo "<br>Erreur, que voici : ".mysqli_error($connect);
    }

    echo "<table>";
    while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
      echo "<form action='supprimer_theme.php' method='post'>";
      echo "<tr>";
      echo "<td>";
      echo "supprimer ce thème : ";
      echo "</td>";
      echo "<td>";
      echo $row[1]. " ?";
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "</tr>";
      echo "<tr>";

      /*echo "<select name='SuppSeance'>";
      echo "<br>";
      echo "<br>";
      echo "<option value='Non'>";
      echo "Non";
      echo "</option>";
      echo "<br>";
      echo "<option value='Oui'>";
      echo "Oui";
      echo "</option>";
      echo "<br>";
      echo "</select>";
      echo "</td>";
      echo "</tr>";
      echo "<br>";

      echo "<tr>";
      echo "<td>";
      echo "</td>";
      */
      echo "<td>";
      echo "<input type='submit' name='theme' class='button' value='Supprimer le thème suivant : ".$row[1]."'>";
      echo "</td>";
      echo "</tr>";
      echo "<tr class='spaceUnder'>";
      echo "<td>";
      echo "<input type='hidden' name='idtheme' value='".$row[0]."'>";
      echo "</td>";
      echo "</tr>";
      echo '</form>';

    }
    echo "</table>";

    mysqli_close($connect);

?>

  </body>
</html>
