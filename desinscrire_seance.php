<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>desinscription Elève</title>
  </head>
  <body>
    <h2>désinscrire un Elève à une seance</h2>
    <?php

    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';


    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

    $idseance = $_POST["idseance"];
    $eleve = $_POST["ideleve"];

    $query = "DELETE from inscription where idseance=$idseance and ideleve=$eleve";
    //echo $query;

    $result = mysqli_query($connect, $query);

    if (!$result)
    {
    echo "<br>pas bon; L'erreur : ".mysqli_error($connect);
    }
    else {
      echo "élève désinscrit";
    }




    mysqli_close($connect);
    ?>


  </body>
</html>
