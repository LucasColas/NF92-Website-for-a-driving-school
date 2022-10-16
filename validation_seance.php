<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <title>Valider une séance</title>
    <link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h2>Valider la séance</h2>
    <?php

    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    //la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

    // Récupérer la date (d'aujourd'hui)
    date_default_timezone_set('Europe/Paris');
    $dateAjd = date("Y\-m\-d");

    $query = "SELECT * FROM seances INNER JOIN themes ON seances.idtheme = themes.idtheme WHERE seances.DateSeance < '".$dateAjd."'";
    $result = mysqli_query($connect, $query);

    if (!$result) {
      echo "<br>Erreur: ".mysqli_error($connect);
    }

    // Affiche toute les séances avec la date et nom du thème
    while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
      echo '<br>';
      echo '<form action="valider_seance.php" method="post" >';
      echo "<input type='hidden' name='idseance' value='".$row[0]."'>";
      echo "<input type='submit' name='dateSeance' class='button' value='Séance du ".$row[1].", le thème est : ".$row[5]."' >";
      echo '</form>';
      echo '</br>';
    }

    mysqli_close($connect)
    ?>

    </form>




  </body>
</html>
