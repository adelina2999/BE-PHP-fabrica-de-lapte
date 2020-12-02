<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Locatie.php';
 
  $database = new Database();
  $db = $database->connect();

  $locatie = new Locatie($db);

  $locatie->id_locatie = isset($_GET['id_locatie']) ? $_GET['id_locatie'] : die();

  $locatie->read_single();

  $locatie_arr = array(
    'id' => $locatie->id_locatie,
    'denumireLocatie' => $locatie->denumire_locatie
  );

  print_r(json_encode($locatie_arr));
