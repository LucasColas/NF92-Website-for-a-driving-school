<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription Elève</title>
  </head>
  <body>
    <h2>Inscrire Elève</h2>
    <?php

    $idseance = $_POST['idseance'];
    $ideleve = $_POST['ideleve'];

    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';

    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

    //Récupération du nombre d'inscrits à une seance
    $query = "SELECT count(*) FROM inscription WHERE idseance = $idseance";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    $nbInscrit = $row[0];

    //Récupération de l'effectif Max d'une séance dans table séances
    $query = "SELECT * FROM seances WHERE idseance = $idseance";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    $effMax = $row[2];

    // Récupération si l'élève est déjà inscrit
    $query = "SELECT * FROM inscription WHERE ideleve = $ideleve AND idseance = $idseance";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);



    if(empty($row) && $nbInscrit < $effMax) {
      $query = "INSERT INTO inscription VALUES ($idseance, $ideleve, -1)";
  		mysqli_query($connect, $query);
  		echo "élève inscrit avec succès";
    } else {
        if(!empty($row)) {
          echo "élève déjà inscrit";
        }

        else {
          echo "effectif max dépassé";
        }
    }
    mysqli_close($connect);
    ?>


  </body>
</html>
