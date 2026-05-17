<?php
ob_start();
session_start();

require_once 'config/Database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/TerrainController.php';
require_once 'controllers/ReservationController.php';
require_once 'controllers/AdminController.php';

$database = new Database();
$db = $database->connect();

if ($db === null) {
    die("<div style='text-align: center; margin-top: 5rem; font-family: sans-serif; padding: 2rem; border: 1px solid red; background: #fee; color: #c00; border-radius: 8px;'>
            <h2>Erreur critique</h2>
            <p>Impossible de se connecter à la base de données. Assurez-vous que <b>MySQL</b> est bien démarré dans XAMPP et que la base de données existe.</p>
         </div>");
}

$authController = new AuthController($db);
$terrainController = new TerrainController($db);
$reservationController = new ReservationController($db);
$adminController = new AdminController($db);

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        require_once 'views/home.php';
        break;
    case 'login':
        $authController->login();
        break;
    case 'register':
        $authController->register();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'terrains':
        $terrainController->index();
        break;
    case 'terrain_detail':
        $id = $_GET['id'] ?? 0;
        $terrainController->show($id);
        break;
    case 'reserve':
        $reservationController->create();
        break;
    case 'my_reservations':
        $reservationController->myReservations();
        break;
    case 'cancel_reservation':
        $id = $_GET['id'] ?? 0;
        $reservationController->cancel($id);
        break;
    
    // Admin routes
    case 'admin_dashboard':
        $adminController->dashboard();
        break;
    case 'admin_users':
        $adminController->users();
        break;
    case 'admin_terrains':
        $adminController->terrains();
        break;
    case 'admin_add_terrain':
        $adminController->addTerrain();
        break;
    case 'admin_delete_terrain':
        $id = $_GET['id'] ?? 0;
        $adminController->deleteTerrain($id);
        break;
    case 'admin_edit_terrain':
        $id = $_GET['id'] ?? 0;
        $adminController->editTerrain($id);
        break;
    case 'admin_reservations':
        $adminController->reservations();
        break;
    case 'admin_update_reservation':
        $id = $_GET['id'] ?? 0;
        $adminController->updateReservationStatus($id);
        break;
    case 'admin_categories':
        $adminController->categories();
        break;
    case 'admin_add_categorie':
        $adminController->addCategorie();
        break;
    case 'admin_edit_categorie':
        $id = $_GET['id'] ?? 0;
        $adminController->editCategorie($id);
        break;
    case 'admin_delete_categorie':
        $id = $_GET['id'] ?? 0;
        $adminController->deleteCategorie($id);
        break;
    default:
        require_once 'views/home.php';
        break;
}
