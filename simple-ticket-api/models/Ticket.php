<?php
class Ticket {
    private $conn;
    private $table = 'tickets';

    public $id;
    public $customer_name;
    public $customer_email;
    public $subject;
    public $body;
    public $status;
    public $priority;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->customer_name = $row['customer_name'];
        $this->customer_email = $row['customer_email'];
        $this->subject = $row['subject'];
        $this->body = $row['body'];
        $this->status = $row['status'];
        $this->priority = $row['priority'];
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' SET customer_name = :customer_name, customer_email = :customer_email, subject = :subject, body = :body, priority = :priority';
        $stmt = $this->conn->prepare($query);

        $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
        $this->customer_email = htmlspecialchars(strip_tags($this->customer_email));
        $this->subject = htmlspecialchars(strip_tags($this->subject));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->priority = htmlspecialchars(strip_tags($this->priority));

        $stmt->bindParam(':customer_name', $this->customer_name);
        $stmt->bindParam(':customer_email', $this->customer_email);
        $stmt->bindParam(':subject', $this->subject);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':priority', $this->priority);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET customer_name = :customer_name, customer_email = :customer_email, subject = :subject, body = :body, status = :status, priority = :priority WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
        $this->customer_email = htmlspecialchars(strip_tags($this->customer_email));
        $this->subject = htmlspecialchars(strip_tags($this->subject));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->priority = htmlspecialchars(strip_tags($this->priority));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':customer_name', $this->customer_name);
        $stmt->bindParam(':customer_email', $this->customer_email);
        $stmt->bindParam(':subject', $this->subject);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':priority', $this->priority);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
?>