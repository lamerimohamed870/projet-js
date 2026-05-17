<?php
class Reservation {
    private $conn;
    private $table_name = "reservations";

    public $id;
    public $user_id;
    public $terrain_id;
    public $date_reservation;
    public $heure_debut;
    public $heure_fin;
    public $statut;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (user_id, terrain_id, date_reservation, heure_debut, heure_fin) 
                  VALUES (:user_id, :terrain_id, :date_reservation, :heure_debut, :heure_fin)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":terrain_id", $this->terrain_id);
        $stmt->bindParam(":date_reservation", $this->date_reservation);
        $stmt->bindParam(":heure_debut", $this->heure_debut);
        $stmt->bindParam(":heure_fin", $this->heure_fin);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getByUser($user_id) {
        $query = "SELECT r.*, t.nom as terrain_nom, t.prix_heure, t.localisation 
                  FROM " . $this->table_name . " r 
                  JOIN terrains t ON r.terrain_id = t.id 
                  WHERE r.user_id = :user_id 
                  ORDER BY r.date_reservation DESC, r.heure_debut DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $query = "SELECT r.*, u.nom as user_nom, u.prenom as user_prenom, t.nom as terrain_nom 
                  FROM " . $this->table_name . " r 
                  JOIN users u ON r.user_id = u.id 
                  JOIN terrains t ON r.terrain_id = t.id 
                  ORDER BY r.date_reservation DESC, r.heure_debut DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $statut) {
        $query = "UPDATE " . $this->table_name . " SET statut = :statut WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":statut", $statut);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function getStats() {
        $stats = [];
        
        // Total users
        $query = "SELECT COUNT(*) as total FROM users WHERE role = 'user'";
        $stmt = $this->conn->query($query);
        $stats['total_users'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Total reservations
        $query = "SELECT COUNT(*) as total FROM reservations";
        $stmt = $this->conn->query($query);
        $stats['total_reservations'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Total terrains
        $query = "SELECT COUNT(*) as total FROM terrains";
        $stmt = $this->conn->query($query);
        $stats['total_terrains'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Most reserved terrain
        $query = "SELECT t.nom, COUNT(r.id) as count 
                  FROM terrains t 
                  LEFT JOIN reservations r ON t.id = r.terrain_id 
                  GROUP BY t.id 
                  ORDER BY count DESC LIMIT 1";
        $stmt = $this->conn->query($query);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['most_reserved'] = $res ? $res['nom'] : 'Aucun';

        // Estimated revenue (validated reservations)
        $query = "SELECT SUM(TIME_TO_SEC(TIMEDIFF(r.heure_fin, r.heure_debut)) / 3600 * t.prix_heure) as revenue 
                  FROM reservations r 
                  JOIN terrains t ON r.terrain_id = t.id 
                  WHERE r.statut = 'validee'";
        $stmt = $this->conn->query($query);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['revenue'] = $res['revenue'] ? round($res['revenue'], 2) : 0;

        return $stats;
    }
}
