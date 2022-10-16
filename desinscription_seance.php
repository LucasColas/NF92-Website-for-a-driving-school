<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Desinscription Elève</title>
    <link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h2>Desinscription d'un Elève à une seance</h2>
    <?php

    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';
    date_default_timezone_set('Europe/Paris');
    $date = date("Y\-m\-d");

    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

    if (empty($_POST["eleve_desIns"])) {
      $query = "SELECT * from eleves";
      //echo "<br>$query<br>";
      $result = mysqli_query($connect, $query);

      if (!$result)
      {
      echo "<br>pas bon; L'erreur : ".mysqli_error($connect);
      }
      echo "<table>";
      echo "<tr>";
      echo "<td>";
      echo "<form action='desinscription_seance.php' method='post'>";
      echo "Choisissez l'élève que vous voulez désinscrire à une séance : ";
      echo "</td>";
      echo "<td>";
      echo "<select name='eleve_desIns'>";
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo "<option value ='$row[0]'>";
        echo $row[2].' '.$row[1].' '.$row[3];
        echo "</option>";
      }
      echo "</select>";
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>";
      echo "</td>";
      echo "<td>";
      echo "<input type='submit' value='Valider' class='button'>";
      echo "</td>";
      echo "</tr>";
      echo "</table>";
    } else {
      $ideleve = $_POST['eleve_desIns'];
      echo "On a choisi un élève";
      $query = "SELECT seances.idseance, seances.DateSeance from seances INNER JOIN inscription ON seances.idseance = inscription.idseance where inscription.ideleve='$ideleve' and seances.DateSeance > '$date'";
      //echo "<br>$query<br>";
      $result = mysqli_query($connect, $query);

      if (!$result)
      {
      echo "<br>pas bon; L'erreur : ".mysqli_error($connect);
      }

      echo "<form action='desinscrire_seance.php' method='post'>";

      echo "Choisissez la séance pour laquelle l'élève sera desinscrit: <select name='idseance'>";
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

        echo "<option value ='$row[0]'>";
        echo $row[1];
        echo "</option>";
      }
      echo "</select>";
      echo "<br>";
      echo "<br>";
      echo "<input type='hidden' name='ideleve' value='$ideleve'>";
      echo "<input type='submit' value='Valider' class='button'>";

    }


    mysqli_close($connect);
    ?>


  </body>
</html>
