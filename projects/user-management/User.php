<?php 

class User {
    private $conn;
    private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($name, $email) {
        //attempt to insert the new user
        $query = "INSERT INTO " . $this->table . " (name, email) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            return "Prepare failed: " . $this->conn->error;
        }
    
        $stmt->bind_param("ss", $name, $email);
    
        try {
            //attempt to execute the query
            if ($stmt->execute()) {
                $stmt->close(); //close after executing
                return true; //successfully created
            }
        } catch (mysqli_sql_exception $e) {
            //catch the exception for duplicate email entry (errno 1062)
            if ($e->getCode() == 1062) {
                $stmt->close();
                return "Email already exists!! Please try again!";
            } else {
                $stmt->close();
                return "Error: " . $e->getMessage();
            }
        }
    
        //default case, if no exceptions were thrown but still failed to execute
        return "Error: " . $stmt->error;
    }
    

    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close(); // close after fetching data
        return $data;
    }

    public function update($id, $name, $email) {
        // check if the email already exists (excluding the current user's email)
        $query = "SELECT * FROM " . $this->table . " WHERE email = ? AND id != ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $email, $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            // if the email exists for a different user
            return "The email is already taken. Please choose another one."; // return error message
        }
    
        // proceed with the update if no duplicate email
        $query = "UPDATE " . $this->table . " SET name = ?, email = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            return "Prepare failed: " . $this->conn->error;
        }
        $stmt->bind_param("ssi", $name, $email, $id);
    
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $error = "Error: " . $stmt->error;
            $stmt->close();
            return $error;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);  
        $stmt->bind_param("i", $id);// this line should exist before executing statement
        $result = $stmt->execute();
        $stmt->close(); // close after executing
        return $result;
    }
}