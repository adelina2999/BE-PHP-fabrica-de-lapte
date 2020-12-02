<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Locatie.php';

  $database = new Database();
  $db = $database->connect();

  $locatie = new Locatie($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $locatie->id_locatie = $data->id_locatie;

  // Delete post
  if($locatie->delete()) {
    echo json_encode(
      array('message' => 'locatie deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'locatie not deleted')
    );
  }
