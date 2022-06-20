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
            $date = $row[0];
            $ville = $row[1];
            $periode = $row[2];
            $resume = $row[3];
            $id_resume = $row[4];
            $temp_min = $row[5];
            $temp_max = $row[6];
            $commentaire = $row[7];

            $mysqli->query('INSERT INTO meteo(day, ville,periode,resume,id_resume,temp_min,temp_max,commentaire)
                          VALUES ("'. $date.'", "'. $ville .'", "'. $periode .'", "'. $resume .'", "'. $id_resume .'", "' . $temp_min .'", "' . $temp_max .'","' . $commentaire .'")');
          }
      }
?>
