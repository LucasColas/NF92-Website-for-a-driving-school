<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajouter Elève</title>
  </head>
  <body>
    <h2>Ajouter Elève</h2>
    <?php
    date_default_timezone_set('Europe/Paris');
    $date = date("Y\-m\-d");


    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';

    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

    if ($_POST["envoyer"] == "Oui") {
      $nom = mysqli_escape_string($connect, $_POST['nom']);
      $prenom = mysqli_escape_string($connect, $_POST['prenom']);
      $dateNaiss = mysqli_escape_string($connect, $_POST['dateNaiss']);

      $query = "insert into eleves values (NULL, '$nom', '$prenom', '$dateNaiss', '$date')";

      //echo "<br>$query<br>";


      $result = mysqli_query($connect, $query);

      if (!$result){
        echo "<br>pas bon  ".mysqli_error($connect);
      }
      else {
        echo "élève ajouté";
      }

    } else {
      echo "élève non ajouté";
    }


    mysqli_close($connect);
    ?>


  </body>
</html>
