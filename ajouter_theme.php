<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Page Accueil</title>
  </head>
  <body>
    <h2>Ajouter thème</h2>
    <?php

    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';

    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    //la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
    //echo $_POST["descriptif"];
    //echo $_POST["theme"];

    //print(empty($_POST["theme"]) || empty($_POST["descriptif"]);
    //trim enleve les espaces en debut et fin de phrase. Si la len de la string est vide : champ vide.
    if (!strlen(trim($_POST['descriptif'])) || !strlen(trim($_POST['descriptif']))) {
      echo "un champ est vide. L'opération a été annulé.";
      echo "<br>";
    } else {
      $nom = mysqli_escape_string($connect,$_POST["theme"]);

      echo "<br> le thème  saisie est : $nom";


      $descriptif = mysqli_escape_string($connect,$_POST["descriptif"]);
      echo "<br> le descriptif saisie est : $descriptif";
      echo "<br>";

      //vérification si le thème n'existe pas déjà.
      $verif = "select * from themes where nom='$nom'";
      //echo $verif;
      $result_verif = mysqli_query($connect, $verif);
      if (!$result_verif)
      {
      echo "<br>pas bon  ".mysqli_error($connect);
      }

      $row_count = mysqli_num_rows($result_verif);
      //vérification que Le theme n'existe pas déjà;
      if ($row_count == 0){
        $query = "insert into themes values (NULL, '$nom', 0, '$descriptif')";

        //echo "<br>$query<br>";

        $result = mysqli_query($connect, $query);

        if (!$result)
        {
        echo "<br>pas bon  ".mysqli_error($connect);
        }
      } else {
        $row = mysqli_fetch_row($result_verif);
        if ($row[2] == 0) {
          echo "le thème existe déjà (et il était déjà actif).";
        }
        else {
          $query="UPDATE themes SET supprime = 0 WHERE nom='$nom'";
          //echo "$query";
          $result = mysqli_query($connect, $query);

          if (!$result)
          {
            echo "<br>pas bon  ".mysqli_error($connect);
          } else {
            echo "le thème a été remis actif.";
          }

        }

      }

    }





    mysqli_close($connect);
    ?>


  </body>
</html>
