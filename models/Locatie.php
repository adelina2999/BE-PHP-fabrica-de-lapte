<?php
  class Locatie {

    private $conn;
    private $table = 'locatie';

    private $id_locatie;
    private $denumire_locatie;

    public function __construct($db) {
      $this->conn = $db;
    }

    public function read() {
      $query = 'SELECT
        *
      FROM
        ' . $this->table;
        
      $stmt = $this->conn->prepare($query);

      $stmt->execute();

      return $stmt;
    }


  public function read_single(){

    $query = 'SELECT
          *
        FROM
          ' . $this->table . '
      WHERE id = ?
      LIMIT 0,1';

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->id_locatie);

      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->id_locatie = $row['id_locatie'];
      $this->denumire_locatie = $row['denumire_locatie'];
  }

  public function create() {
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      denumire_lcatie = :denumire_locatie';

    $stmt = $this->conn->prepare($query);

    $this->denumire_locatie = htmlspecialchars(strip_tags($this->denumire_locatie));

    $stmt-> bindParam(':name', $this->denumire_locatie);

    if($stmt->execute()) {
      return true;
    }

    printf("Error: $s.\n", $stmt->error);

    return false;
  }


  public function update() {
    $query = 'UPDATE ' .
      $this->table . '
    SET
      denumire_locatie = :denumire_locatie
      WHERE
      id_locatie = :id_locatie';

    $stmt = $this->conn->prepare($query);

    $this->denumire_locatie = htmlspecialchars(strip_tags($this->denumire_locatie));
    $this->id_locatie = htmlspecialchars(strip_tags($this->id_locatie));

    $stmt-> bindParam(':denumire_locatie', $this->denumire_locatie);
    $stmt-> bindParam(':id_locatie', $this->id_locatie);

    if($stmt->execute()) {
    return true;
    }

    printf("Error: $s.\n", $stmt->error);

    return false;
  }

  public function delete() {
    $query = 'DELETE FROM ' . $this->table . ' WHERE id_locatie = :id_locatie';

    $stmt = $this->conn->prepare($query);

    $this->id_locatie = htmlspecialchars(strip_tags($this->id_locatie));

    $stmt-> bindParam(':id_locatie', $this->id_locatie);

    if($stmt->execute()) {
      return true;
    }

    printf("Error: $s.\n", $stmt->error);

    return false;
  }
}
