<?php 
  class student {
    // Database stuff
    private $conn;
    private $table = 'student';

    // Student Properties
    public $id;
    public $name;
    public $age;
    public $stdd;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get students
    public function read() {
      // Create query
      $query = 'SELECT s.id, s.name, s.age, s.stdd, s.created_at
                                FROM ' . $this->table . ' s
                                ORDER BY
                                  s.created_at DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Student
    public function read_single() {
          // Create query
          $query = 'SELECT s.id, s.name, s.age, s.stdd, s.created_at
                                    FROM ' . $this->table . ' s
                                    WHERE
                                      s.id = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->name = $row['name'];
          $this->age = $row['age'];
          $this->stdd = $row['stdd'];
    }

    // Create Student
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET name = :name, age = :age, stdd = :stdd';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->age = htmlspecialchars(strip_tags($this->age));
          $this->stdd = htmlspecialchars(strip_tags($this->stdd));
          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':age', $this->age);
          $stmt->bindParam(':stdd', $this->stdd);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Student
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET name = :name, age = :age, stdd = :stdd 
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->age = htmlspecialchars(strip_tags($this->age));
          $this->stdd = htmlspecialchars(strip_tags($this->stdd));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':age', $this->age);
          $stmt->bindParam(':stdd', $this->stdd);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Student
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }