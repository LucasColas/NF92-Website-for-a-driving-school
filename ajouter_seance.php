<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajouter séance</title>
    <link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h2>Ajouter Séance </h2>
    <?php

    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';

    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
    date_default_timezone_set('Europe/Paris');
    $dateAjd = date("Y\-m\-d");
    $date = mysqli_escape_string($connect,$_POST["date"]);
    $idtheme = mysqli_escape_string($connect,$_POST["theme"]);
    $effmax = mysqli_escape_string($connect,$_POST["effmax"]);

    if (empty($date) || empty($idtheme) || empty($effmax)) {
      echo "un des champs est vide...";

    } else {
      $query = "SELECT * FROM seances WHERE DateSeance = '$date' and Idtheme = '$idtheme'";
      //echo "<br>$query<br>";

      $result = mysqli_query($connect, $query);
      if (!$result)
      {
      echo "<br>pas bon  ".mysqli_error($connect);
      }


      if (!empty(mysqli_fetch_array($result))) {
        echo "Il existe déjà une séance. La séance n'a donc pas été ajouté.";
      }
      else {
        if ($date < $dateAjd) {
          echo "Vous ne pouvez pas créer une séance avec une date passée ! ";
        }
        else {
          $query_insert = "insert into seances values (NULL, '$date', $effmax, $idtheme)";
          //echo $query_insert;
          $resultat = mysqli_query($connect, $query_insert);
          if (!$resultat)
          {
          echo "<br>pas bon  ".mysqli_error($connect);
        } else {
          echo "<br>";
          echo "séance ajouté";
        }
        }


      }
    }

    //echo "<br> le thème saisi est : $idtheme";
    /*
    $query = "SELECT * FROM seances WHERE DateSeance = '$date' and Idtheme = '$idtheme'";
    //echo "<br>$query<br>";

    $result = mysqli_query($connect, $query);
    if (!$result)
    {
    echo "<br>pas bon  ".mysqli_error($connect);
    }


    if (!empty(mysqli_fetch_array($result))) {
      echo "Il existe déjà une séance";
    } else {
      if ($date < $dateAjd) {
        echo "Vous ne pouvez pas créer une séance avec une date passée ! ";

      } else {
        if (empty($date) || empty($idtheme) || empty($effmax)) {
          echo "un des champs est vide...";
        } else {
          $query_insert = "insert into seances values (NULL, '$date', $effmax, $idtheme)";
          //echo $query_insert;
          $resultat = mysqli_query($connect, $query_insert);
          if (!$resultat)
          {
          echo "<br>pas bon  ".mysqli_error($connect);
        } else {
          echo "<br>";
          echo "séance ajouté";
        }

        }


      }
    }
    */
    mysqli_close($connect);
    ?>


  </body>
</html>
