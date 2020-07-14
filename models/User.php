<?php

class User {

	// Db conection
	private $con;
	private $table = 'users';

	// User properties
	public $id;
	public $name;
	public $age;
	public $email;
	public $contact;
	public $updated_at;
	public $created_at;

	// constructor with DB
	public function __construct($db) {
		$this->con = $db;
	}

	// get users
	public function read() {
		$query = "SELECT * FROM " . $this->table;

		$stmt = $this->con->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	// Get Single user
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';

          // Prepare statement
          $stmt = $this->con->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->id = $row['id'];
          $this->name = $row['name'];
          $this->age = $row['age'];
          $this->email = $row['email'];
          $this->contact = $row['contact'];
          $this->updated_at = $row['updated_at'];
          $this->created_at = $row['created_at'];
    }

    // Create User
    public function create() {
          // Create query
          $query = '
          INSERT INTO ' . $this->table . ' 
          SET 
          name = :name, 
          age = :age, 
          email = :email, 
          contact = :contact
          ';

          // Prepare statement
          $stmt = $this->con->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->age = htmlspecialchars(strip_tags($this->age));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->contact = htmlspecialchars(strip_tags($this->contact));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':age', $this->age);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':contact', $this->contact);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update User
    public function update() {
          // Create query
          $query = '
          UPDATE ' . $this->table . '
		  SET 
          name = :name, 
          age = :age, 
          email = :email, 
          contact = :contact,
          updated_at = :updated_at
		  WHERE id = :id';
          // Prepare statement
          $stmt = $this->con->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->age = htmlspecialchars(strip_tags($this->age));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->contact = htmlspecialchars(strip_tags($this->contact));
          $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':age', $this->age);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':contact', $this->contact);
          $stmt->bindParam(':updated_at', $this->updated_at);
          $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete User
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->con->prepare($query);

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
?>