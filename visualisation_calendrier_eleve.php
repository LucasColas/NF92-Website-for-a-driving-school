<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Visualisation calendrier eleve</title>
    <link href="style.css" rel="stylesheet" type="text/css">
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
    echo "<form action='visualiser_calendrier_eleve.php' method='post'>";
    echo "Choisissez l'élève pour voir ses prochaines séances de code : ";
    echo "</td>";
    echo "<td>";
    echo "<select name='eleve'>";

    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
      echo "<option value ='$row[0]'>";
      echo $row[2].' '.$row[1].' '.$row[3];
      echo "</option>";
    }
    echo "</select>";
    echo "<td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td></td>";
    echo "<td>";
    echo "<input type='submit' value='Valider' class='button'>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";


    mysqli_close($connect);
    ?>


  </body>
</html>
