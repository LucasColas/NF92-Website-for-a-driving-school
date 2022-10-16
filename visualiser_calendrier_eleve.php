<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Visualisation calendrier eleve</title>
  </head>
  <body>
    <h2>Visualisation calendrier eleve</h2>
    <?php

    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';

    date_default_timezone_set('Europe/Paris');
    $date = date("Y\-m\-d");

    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

    $eleve = $_POST['eleve'];

    $query = "SELECT DateSeance, seances.idtheme from seances INNER JOIN inscription ON
    seances.idseance = inscription.idseance WHERE inscription.ideleve = $eleve AND
    seances.DateSeance > $date";
    //echo "<br>$query<br>";
    $result = mysqli_query($connect, $query);

    if (!$result) {
      echo "erreur : ".mysqli_error($connect);
    } else {
      $seance_futur = false;
      echo "<table>";

      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        if ($row[0] > $date) {
          $seance_futur = true;
          echo "<tr>";

          echo "<td>"."l'élève est inscrit à la séance du : "."</td>". "<td>" ."$row[0]". "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>"."La séance est sur le thème : "."</td>";
          $query_theme = "SELECT nom FROM themes where idtheme=$row[1]";
          $result_theme = mysqli_query($connect, $query_theme);
          echo "<td>";
          if (!$result_theme) {
            echo "erreur : ". mysqli_error($connect);
          } else {
            while ($row_t = mysqli_fetch_array($result_theme, MYSQLI_NUM)) {
              echo $row_t[0];
              echo "<br>";
            }
          echo "</td>";
          echo "</tr>";
          for ($i = 0; $i < 2; $i++) {
            echo "<tr>";
            echo "<td>"."</td>";
            echo "<td>"."</td>";
            echo "</tr>";
          }
          }

        }
      }

      if (!$seance_futur) {
        echo "l'élève est inscrit à aucune séance dans le futur.";
      }
    }





    mysqli_close($connect);
    ?>


  </body>
</html>
