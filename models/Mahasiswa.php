<?php
class Mahasiswa {
    private $conn;
    private $table_name = "mahasiswa";

    public $id;
    public $npm;
    public $nama;
    public $jurusan;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET npm=:npm, nama=:nama, jurusan=:jurusan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":npm", $this->npm);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":jurusan", $this->jurusan);
        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET npm=:npm, nama=:nama, jurusan=:jurusan WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":npm", $this->npm);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":jurusan", $this->jurusan);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}
?>