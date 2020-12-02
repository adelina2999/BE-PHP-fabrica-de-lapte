<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Locatie.php';

  $database = new Database();
  $db = $database->connect();

  $locatie = new Locatie($db);

  $data = json_decode(file_get_contents("php://input"));

  $locatie->id_locatie = $data->id_locatie;

  $locatie->name = $data->denumire_locatie;

  if($locatie->update()) {
    echo json_encode(
      array('message' => 'locatie Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'locatie not updated')
    );
  }
