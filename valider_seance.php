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

    $idseance = $_POST['idseance'];

    $query = "SELECT * FROM inscription INNER JOIN eleves on inscription.ideleve = eleves.ideleve WHERE idseance=$idseance";
    $result = mysqli_query($connect, $query);

    if (!$result) {
      echo "<br>Erreur: ".mysqli_error($connect);
    }

    echo "<form action='noter_eleves.php' method='post' >";
    echo "<input type='hidden' name='idseance' value=$idseance>";
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
      echo "Attribuer à : ".$row[6]." ".$row[5]. " la note ";
      echo "<input type='number' min='0' max='40' name='".$row[1]."' value='".$row[2]."' >";
      echo"</br>";
    }

    echo "<input type='submit' value='Valider' class='button'>";
    echo "</form>";

    mysqli_close($connect)
    ?>






  </body>
</html>
