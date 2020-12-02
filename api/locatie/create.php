<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Locatie.php';

  $database = new Database();
  $db = $database->connect();

  $locatie = new Locatie($db);

  $data = json_decode(file_get_contents("php://input"));

  $locatie->denumire_locatie = $locatie->denumire_locatie;

  if($locatie->create()) {
    echo json_encode(
      array('message' => 'locatie Created')
    );
  } else {
    echo json_encode(
      array('message' => 'locatie Not Created')
    );
  }
