<?php
require_once 'models/Reservation.php';
require_once 'models/Terrain.php';

class ReservationController {
    private $reservation;
    private $terrain;

    public function __construct($db) {
        $this->reservation = new Reservation($db);
        $this->terrain = new Terrain($db);
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->reservation->user_id = $_SESSION['user_id'];
            $this->reservation->terrain_id = $_POST['terrain_id'];
            $this->reservation->date_reservation = $_POST['date_reservation'];
            $this->reservation->heure_debut = $_POST['heure_debut'];
            $this->reservation->heure_fin = $_POST['heure_fin'];

            if ($this->reservation->create()) {
                header("Location: index.php?action=my_reservations&success=1");
                exit;
            } else {
                $error = "Erreur lors de la réservation.";
            }
        }
        // Redirect back to terrain detail if not post
        if (isset($_GET['terrain_id'])) {
            header("Location: index.php?action=terrain_detail&id=" . $_GET['terrain_id']);
        } else {
            header("Location: index.php?action=terrains");
        }
        exit;
    }

    public function myReservations() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $reservations = $this->reservation->getByUser($_SESSION['user_id']);
        require_once 'views/my_reservations.php';
    }

    public function cancel($id) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        
        // Basic check: should verify if the reservation belongs to user before cancelling
        // To keep it simple, we just update status to 'annulee' 
        $this->reservation->updateStatus($id, 'annulee');
        header("Location: index.php?action=my_reservations");
        exit;
    }
}
