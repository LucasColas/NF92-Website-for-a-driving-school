<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Supprimer Thème</title>
  </head>
  <body>
    <h2>Supprimer Thème</h2>
    <?php

    $dbhost = '';
    $dbuser = '';
    $dbpass = '';
    $dbname = '';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    //la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
    mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8


    $idtheme = $_POST["idtheme"];


    $query = "UPDATE themes SET supprime = 1 WHERE idtheme=$idtheme";
    //echo "$query";
    $result = mysqli_query($connect, $query);

    if (!$result) {
        echo "<br>Erreur: ".mysqli_error($connect);
    }

    else {
      echo "Thème supprimé";
      echo "<br>";
    }
    /*

    if ($_POST["SuppSeance"] == "Oui") {
      echo "<br>";
      echo "On supprime aussi les séances futurs sur ce thème";
      $query2 = "SELECT * FROM seances WHERE idtheme=$idtheme";
      //echo "$query2";
      $result2 = mysqli_query($connect, $query2);
      if (!$result2) {
        echo "<br>Erreur: ".mysqli_error($connect);
      }
      while($row2=mysqli_fetch_array($result2, MYSQLI_NUM))
			{
				// Comparaison des dates pour vérifier que la séance est future
				if($row2[1] > $dateAjd)
				{
					// Création de la requête pour la suppression de la séance
					$query3 = "DELETE FROM seances WHERE idseance = $row2[0]";
          //echo "$query3";
					$result3 = mysqli_query($connect, $query3);
          if (!$result3) {
            echo "<br>Erreur: ".mysqli_error($connect);
          }
					// Création de la requête pour la suppression des inscriptions à la séance
					$query4 = "DELETE FROM inscription WHERE idseance = $row2[0]";
          //echo "$query4";
					$result4 = mysqli_query($connect, $query4);
          if (!$result4) {
            echo "<br>Erreur: ".mysqli_error($connect);
          }
				}
			}
    } else {
      echo "On ne supprime pas les séances futurs.";
      echo "<br>";
    }
    */

    mysqli_close($connect);

    ?>

  </body>
</html>
