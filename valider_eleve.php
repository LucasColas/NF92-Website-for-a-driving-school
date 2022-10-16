<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Valider Elève</title>
    <link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h2>Valider Elève</h2>
    <?php

    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';

    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

    //trim enleve les espaces en debut et fin de phrase. Si la len de la string est vide : champ vide.
    if (!strlen(trim($_POST['nom'])) || !strlen(trim($_POST['prenom'])) || !strlen($_POST['dateNaiss'])) {
      echo "un champ est vide. L'opération a été annulé.";
      echo "<br>";
      exit;
    }
    $nom = mysqli_escape_string($connect, $_POST['nom']);
    $prenom = mysqli_escape_string($connect, $_POST['prenom']);
    $dateNaiss = mysqli_escape_string($connect, $_POST['dateNaiss']);



    if (empty($nom) || empty($prenom) || empty($dateNaiss)) {
      echo "un des champs est vide. L'opération a été annulé.";

    } else {
      $query = "select * from eleves where nom='$nom' AND prenom='$prenom'";
      $result = mysqli_query($connect, $query);
      if (!$result)
      {
        echo "<br>pas bon  ".mysqli_error($connect);
      }
      $row_count = mysqli_num_rows($result);
      if ($row_count == 0) {
        //pas d'homonyme
        date_default_timezone_set('Europe/Paris');
        $date = date("Y\-m\-d");
        echo "<br> Vous vous êtes inscrits le : ".$date."<br>";


        $query = "insert into eleves values (NULL, '$nom', '$prenom', '$dateNaiss', '$date')";

        echo "<br>$query<br>";
        $result = mysqli_query($connect, $query);


        if (!$result)
        {
          echo "<br>pas bon  ".mysqli_error($connect);
        }
        else {
          echo "élève ajouté";
        }


      }
      else {
        //homonyme
        echo "<FORM METHOD='POST' ACTION='ajouter_eleve.php' >";
        echo "homonyme détecté, confirmer ?";
        echo "<input type='hidden' name='nom' value=$nom>";
        echo "<input type='hidden' name='prenom' value=$prenom>";
        echo "<input type='hidden' name='dateNaiss' value=$dateNaiss>";
        echo "<input type='submit' name='envoyer' value='Oui' class='button'>";
        echo "<input type='submit' name='envoyer' value='Non' class='button'>";

      }

    }

    mysqli_close($connect);

    ?>


  </body>
</html>
