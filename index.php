<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link  rel="stylesheet" href="style.css" type="text.css"/>
    <title> meteo </title>
  </head>
  <body>
    <?php
      $mysqli = new mysqli('localhost','root','','projet_meteo');
      $mysqli->set_charset("utf8");
      if ($mysqli->connect_errno)
        {
          echo 'Echec de la connection' . $mysqli->connect_error;
          exit();
        }
      if (($handle = fopen("paris.csv" , "r")) !==FALSE)
          {
            while (($data = fgetcsv($handle, 1000, ",")) !==FALSE)
              {
                $data_utf8= array();
                foreach($data as $item_data)
                  {
                    $var = str_replace ('é','e',$item_data);
                    $row[] = str_replace('è','e',$var);
                  }
                $data_utf8[] = $row;
                $jour = $row[0];
                $ville = $row[1];
                $periode = $row[2];
                $resume = $row[3];
                $id_resume = $row[4];
                $temp_min = $row[5];
                $temp_max = $row[6];
                $commentaire = $row[7];

                $mysqli->query('INSERT INTO meteo(jour, ville,periode,resume,id_resume,temp_min,temp_max,commentaire)
                              VALUES ("'. $date.'", "'. $ville .'", "'. $periode .'", "'. $resume .'", "'. $id_resume .'", "' . $temp_min .'", "' . $temp_max .'","' . $commentaire .'")');
              }
          }

    ?>
    <h1>Service météo</h1>
    <table>
      <tr>
        <th colspan="8"><h2>Prévision Météo sur Paris</h2></th>
      </tr>
      <t>
        <th>Date</th>
        <th>Ville</th>
        <th>Période</th>
        <th>Cv</th>
        <th>Cv id</th>
        <th>Temp Minimum</th>
        <th>Temp Maximum</th>
        <th>commentaire</th>
      </t>
      <tr>
        <td><?php echo $data_utf8[0];?></td>
        <td><?php echo $data_utf8[1];?></td>
        <td><?php echo $data_utf8[2];?></td>
        <td><?php echo $data_utf8[3];?></td>
        <td><?php echo $data_utf8[4];?></td>
        <td><?php echo $data_utf8[5];?></td>
        <td><?php echo $data_utf8[6];?></td>
        <td><?php echo $data_utf8[7];?></td>
      </tr>
    </table>
  </body>
</html>
