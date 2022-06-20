<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link  rel="stylesheet" href="style.css" type="text/css"/>
    <title> meteo </title>
  </head>
  <body>
    <?php
      $aujourdhui = "2100-12-05";
      $aujDate = getDate(strtotime($aujourdhui));
      $infosAffiche = array();

      $mysqli = new mysqli('localhost','root','','projet_meteo');
      $mysqli->set_charset("utf8");
      if ($mysqli->connect_errno)
        {
          echo 'Echec de la connection' . $mysqli->connect_error;
          exit();
        }
      if (($handle = fopen("paris.csv" , "r")) !==FALSE)
          {
            while (($data = fgetcsv($handle, 1000, ";")) !==FALSE)
              {
                $tempDate = getDate(strtotime($data[0]));

                if ($tempDate > $aujDate) {
                  array_push($infosAffiche, $data); 
                }

                $mysqli->query('INSERT INTO meteo(jour, ville,periode,resume,id_resume,temp_min,temp_max,commentaire)
                              VALUES ("'. $data[0].'", "'. $data[1] .'", "'. $data[2] .'", "'. $data[3] .'", "'. $data[4] .'", "' . $data[5] .'", "' . $data[6] .'","' . $data[7] .'")');
              }
          }

    ?>
    <h1>Service météo</h1>
    <h2>Prévision Météo sur Paris</h2>
    <table>
      <thead>
        <th>Date</th>
        <th>Ville</th>
        <th>Période</th>
        <th>Cv</th>
        <th>Cv id</th>
        <th>Temp Minimum</th>
        <th>Temp Maximum</th>
        <th>commentaire</th>
      </thead>
        
      <tbody>
      <?php 
        foreach ($infosAffiche as $date) {
          echo '<tr>';
          echo  '<td>'. $date[0] .'</td>';
          echo  '<td>'. $date[1] .'</td>';
          echo  '<td>'. $date[2] .'</td>';
          echo  '<td>'. $date[3] .'</td>';
          echo  '<td>'. $date[4] .'</td>';
          echo  '<td>'. $date[5] .'</td>';
          echo  '<td>'. $date[6] .'</td>';
          echo  '<td>'. $date[7] .'</td>';
          echo '</tr>';
        }
      ?>
      </tbody>
    </table>
  </body>
</html>
