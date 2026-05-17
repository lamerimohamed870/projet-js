<?php
class Avis {
    private $conn;
    private $table_name = "avis";

    public $id;
    public $user_id;
    public $terrain_id;
    public $note;
    public $commentaire;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT a.*, u.nom as user_nom, u.prenom as user_prenom, t.nom as terrain_nom 
                  FROM " . $this->table_name . " a
                  LEFT JOIN users u ON a.user_id = u.id
                  LEFT JOIN terrains t ON a.terrain_id = t.id
                  ORDER BY a.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByTerrain($terrain_id) {
        $query = "SELECT a.*, u.nom as user_nom, u.prenom as user_prenom 
                  FROM " . $this->table_name . " a
                  LEFT JOIN users u ON a.user_id = u.id
                  WHERE a.terrain_id = :terrain_id
                  ORDER BY a.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":terrain_id", $terrain_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (user_id, terrain_id, note, commentaire) 
                  VALUES (:user_id, :terrain_id, :note, :commentaire)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":terrain_id", $this->terrain_id);
        $stmt->bindParam(":note", $this->note);
        $stmt->bindParam(":commentaire", $this->commentaire);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET note = :note, commentaire = :commentaire 
                  WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":note", $this->note);
        $stmt->bindParam(":commentaire", $this->commentaire);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":user_id", $this->user_id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
