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

    $idseance = $_POST["idseance"];

    foreach ($_POST as $key => $value) {
      if (is_numeric($key)) {
        $query = "UPDATE inscription SET note=$value WHERE ideleve = $key AND idseance = $idseance";
        $result = mysqli_query($connect,$query);

        if (!$result) {
          echo "<br>Erreur pour cette modification : ".mysqli_error($connect);
        } else {
          echo "Note modifiée avec succès";
        }
      }
    }

    mysqli_close($connect)
    ?>


  </body>
</html>
