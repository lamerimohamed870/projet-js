<?php
require_once 'models/User.php';
require_once 'models/Terrain.php';
require_once 'models/Reservation.php';
require_once 'models/Categorie.php';

class AdminController {
    private $user;
    private $terrain;
    private $reservation;
    private $categorie;

    public function __construct($db) {
        $this->user = new User($db);
        $this->terrain = new Terrain($db);
        $this->reservation = new Reservation($db);
        $this->categorie = new Categorie($db);
    }

    private function checkAdmin() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
            header("Location: index.php");
            exit;
        }
    }

    public function dashboard() {
        $this->checkAdmin();
        $stats = $this->reservation->getStats();
        require_once 'views/admin/dashboard.php';
    }

    public function users() {
        $this->checkAdmin();
        $users = $this->user->getAllUsers();
        require_once 'views/admin/users.php';
    }

    public function terrains() {
        $this->checkAdmin();
        $terrains = $this->terrain->getAll();
        require_once 'views/admin/terrains.php';
    }

    public function addTerrain() {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->terrain->nom = $_POST['nom'];
            $this->terrain->categorie_id = $_POST['categorie_id'];
            $this->terrain->description = $_POST['description'];
            $this->terrain->prix_heure = $_POST['prix_heure'];
            $this->terrain->localisation = $_POST['localisation'];
            $this->terrain->statut = $_POST['statut'];
            
            // Handle file upload
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                $target_dir = "public/uploads/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                $new_file_name = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $new_file_name;
                
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $this->terrain->image = $new_file_name;
                } else {
                    $this->terrain->image = 'default.jpg';
                }
            } else {
                $this->terrain->image = 'default.jpg';
            }

            $this->terrain->create();
            header("Location: index.php?action=admin_terrains");
            exit;
        }
        $categories = $this->categorie->getAll();
        require_once 'views/admin/add_terrain.php';
    }

    public function deleteTerrain($id) {
        $this->checkAdmin();
        $this->terrain->delete($id);
        header("Location: index.php?action=admin_terrains");
        exit;
    }

    public function reservations() {
        $this->checkAdmin();
        $reservations = $this->reservation->getAll();
        require_once 'views/admin/reservations.php';
    }

    public function updateReservationStatus($id) {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $statut = $_POST['statut'];
            $this->reservation->updateStatus($id, $statut);
        }
        header("Location: index.php?action=admin_reservations");
        exit;
    }

    public function categories() {
        $this->checkAdmin();
        $categories = $this->categorie->getAll();
        require_once 'views/admin/categories.php';
    }

    public function addCategorie() {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->categorie->nom = $_POST['nom'];
            $this->categorie->description = $_POST['description'];
            $this->categorie->create();
            header("Location: index.php?action=admin_categories");
            exit;
        }
        require_once 'views/admin/add_categorie.php';
    }

    public function deleteCategorie($id) {
        $this->checkAdmin();
        $this->categorie->delete($id);
        header("Location: index.php?action=admin_categories");
        exit;
    }

    public function editTerrain($id) {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->terrain->id = $id;
            $this->terrain->nom = $_POST['nom'];
            $this->terrain->categorie_id = $_POST['categorie_id'];
            $this->terrain->description = $_POST['description'];
            $this->terrain->prix_heure = $_POST['prix_heure'];
            $this->terrain->localisation = $_POST['localisation'];
            $this->terrain->statut = $_POST['statut'];
            
            // Handle file upload
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                $target_dir = "public/uploads/";
                $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                $new_file_name = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $new_file_name;
                
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $this->terrain->image = $new_file_name;
                }
            } else {
                $this->terrain->image = ''; // Don't update image if not uploaded
            }

            $this->terrain->update();
            header("Location: index.php?action=admin_terrains");
            exit;
        }
        $terrain = $this->terrain->getById($id);
        $categories = $this->categorie->getAll();
        require_once 'views/admin/edit_terrain.php';
    }

    public function editCategorie($id) {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->categorie->id = $id;
            $this->categorie->nom = $_POST['nom'];
            $this->categorie->description = $_POST['description'];
            $this->categorie->update();
            header("Location: index.php?action=admin_categories");
            exit;
        }
        $categorie = $this->categorie->getById($id);
        require_once 'views/admin/edit_categorie.php';
    }
}
