<?php

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $email;
    public $password;
    public $role_name;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET username=?, email=?, password=?, role_name=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssss", $this->username, $this->email, $this->password, $this->role_name);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // ... autres méthodes si nécessaire
}

?>
