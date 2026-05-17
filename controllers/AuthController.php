<?php
require_once 'models/User.php';

class AuthController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function login() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($this->user->login($email, $password)) {
                $_SESSION['user_id'] = $this->user->id;
                $_SESSION['user_nom'] = $this->user->nom;
                $_SESSION['user_prenom'] = $this->user->prenom;
                $_SESSION['user_role'] = $this->user->role;

                if ($this->user->role == 'admin') {
                    header("Location: index.php?action=admin_dashboard");
                } else {
                    header("Location: index.php");
                }
                exit;
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        }
        require_once 'views/login.php';
    }

    public function register() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->user->nom = $_POST['nom'] ?? '';
            $this->user->prenom = $_POST['prenom'] ?? '';
            $this->user->email = $_POST['email'] ?? '';
            $this->user->password = $_POST['password'] ?? '';

            if ($this->user->register()) {
                header("Location: index.php?action=login");
                exit;
            } else {
                $error = "Erreur lors de l'inscription.";
            }
        }
        require_once 'views/register.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}
