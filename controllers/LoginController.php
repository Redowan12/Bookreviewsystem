<?php
session_start();
require_once "../config/database.php";

class LoginController {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: ../views/user/dashboard.php");
            exit;
        } else {
            echo "Invalid login credentials!";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new LoginController();
    $controller->login($_POST['username'], $_POST['password']);
}
