<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Locatie.php';

  $database = new Database();
  $db = $database->connect();

  $locatie = new Locatie($db);

  $result = $locatie->read();

  $num = $result->rowCount();

  if($num > 0) {
        
        $locatie_arr = array();
        $locatie_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $locatie_item = array(
            'id' => $id_locatie,
            'denumireLocatie' => $denumire_locatie
          );

          array_push($locatie_arr['data'], $locatie_item);
        }

        echo json_encode($locatie_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No locatie Found')
        );
  }
