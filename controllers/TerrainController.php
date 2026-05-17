<?php
require_once 'models/Terrain.php';
require_once 'models/Categorie.php';

class TerrainController {
    private $terrain;
    private $categorie;

    public function __construct($db) {
        $this->terrain = new Terrain($db);
        $this->categorie = new Categorie($db);
    }

    public function index() {
        $terrains = $this->terrain->getAll();
        $categories = $this->categorie->getAll();
        require_once 'views/terrains.php';
    }

    public function show($id) {
        $terrain = $this->terrain->getById($id);
        if (!$terrain) {
            header("Location: index.php?action=terrains");
            exit;
        }
        require_once 'views/terrain_detail.php';
    }
}
