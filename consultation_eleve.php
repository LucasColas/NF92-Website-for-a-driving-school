<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Consultation Eleves</title>
    <link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h2>Consultation Eleves</h2>
    <?php
    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';

    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    //la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

    $query = "select * from eleves";
    //echo "$query";
    $result = mysqli_query($connect, $query);
    if (!$result) {
      echo "erreur : ".mysql_error($connect);
    }
    else {
      //Consulter un élève

      echo "<table>";
      while ($row  = mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo "<form action='consulter_eleve.php' method='post'>";
        echo "<tr>";
        echo "<td>";
        echo "<input type='hidden' name='ideleve' value = '$row[0]'>";
        echo "<input type='submit' value = 'consulter". "$row[0], $row[3], $row[2], $row[1] " ."' class='button'>";
        echo "</td>";
        echo "</tr>";
        echo "<tr class='spaceUnder'>";
        echo "<td>";
        echo "</td>";
        echo "</tr>";
        echo "</form>";

      }
      echo "</table>";
    }

    mysqli_close($connect);
    ?>

  </body>
</html>
