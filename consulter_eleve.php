<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Consultation Eleves</title>
  </head>
  <body>
    <h2>Consultation Eleves</h2>
    <?php
    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';

    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    //la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

    $ideleve = $_POST["ideleve"];
    $query = "select * from eleves where ideleve='$ideleve'";
    //echo $query;
    $result = mysqli_query($connect, $query);
    if (!$result) {
      echo "erreur : ".mysql_error($connect);
    }
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
      echo "id : "."$row[0] ";
      echo "<br>";
      echo "nom : "."$row[1] ";
      echo "<br>";
      echo "prénom : "."$row[2] ";
      echo "<br>";
      echo "date de naissance : ". "$row[3] ";
      echo "<br>";
      echo "inscrit le : ". "$row[4]";
    }


    mysqli_close($connect);
    ?>

  </body>
</html>
