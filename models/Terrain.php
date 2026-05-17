<?php
class Terrain {
    private $conn;
    private $table_name = "terrains";

    public $id;
    public $nom;
    public $categorie_id;
    public $description;
    public $prix_heure;
    public $localisation;
    public $image;
    public $statut;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT t.*, c.nom as type FROM " . $this->table_name . " t LEFT JOIN categories c ON t.categorie_id = c.id ORDER BY t.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT t.*, c.nom as type FROM " . $this->table_name . " t LEFT JOIN categories c ON t.categorie_id = c.id WHERE t.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nom, categorie_id, description, prix_heure, localisation, image, statut) 
                  VALUES (:nom, :categorie_id, :description, :prix_heure, :localisation, :image, :statut)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":categorie_id", $this->categorie_id);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":prix_heure", $this->prix_heure);
        $stmt->bindParam(":localisation", $this->localisation);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":statut", $this->statut);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nom = :nom, categorie_id = :categorie_id, description = :description, prix_heure = :prix_heure, localisation = :localisation, statut = :statut";
        
        if(!empty($this->image)) {
            $query .= ", image = :image";
        }
        
        $query .= " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":categorie_id", $this->categorie_id);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":prix_heure", $this->prix_heure);
        $stmt->bindParam(":localisation", $this->localisation);
        $stmt->bindParam(":statut", $this->statut);
        $stmt->bindParam(":id", $this->id);
        
        if(!empty($this->image)) {
            $stmt->bindParam(":image", $this->image);
        }

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
