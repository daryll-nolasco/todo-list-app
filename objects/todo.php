<?php
class Todo {
 
    // database connection and table name
    private $conn;
    private $table_name = "todo";
 
    // object properties
    public $id;
    public $title;
    public $description;
    public $status;
    public $create_date;
    public $task_date;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read() {
     
        // select all query
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    function create() {
     
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    title=:title, description=:description, task_date=:task_date";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->task_date=htmlspecialchars(strip_tags($this->task_date));
     
        // bind values
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":task_date", $this->task_date);
     
        // execute query
        if ($stmt->execute()) {
            return true;
        }
     
        return false;
    }

    function update() {
     
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    title = :title,
                    description = :description,
                    status = :status,
                    task_date = :task_date
                WHERE
                    id = :id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->task_date=htmlspecialchars(strip_tags($this->task_date));
        $this->id=htmlspecialchars(strip_tags($this->id));
     
        // bind new values
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':task_date', $this->task_date);
        $stmt->bindParam(':id', $this->id);
     
        // execute the query
        if ($stmt->execute()) {
            return true;
        }
     
        return false;
    }


    function delete() {
     
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
     
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
     
        // execute query
        if ($stmt->execute()) {
            return true;
        }
     
        return false;
    }
}