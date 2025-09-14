
<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

// Initialize DB connection
$database = new Database();
$db = $database->getConnection();

// Create User object
$user = new User($db);

/* ===============================
   🔹 Handle Signup
   =============================== */
if (isset($_POST['signup'])) {
    $user->username = $_POST['username'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->role = $_POST['role']; // 👈 added role (admin/user)

    if ($user->signup()) {
        header("Location: ../views/auth/login.php?success=1");
        exit;
    } else {
        header("Location: ../views/auth/signup.php?error=1");
        exit;
    }
}

/* ===============================
   🔹 Handle Login
   =============================== */
if (isset($_POST['login'])) {
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    $userData = $user->login();

    if ($userData && password_verify($_POST['password'], $userData['password'])) {
        // Store session data
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['username'] = $userData['username'];
        $_SESSION['role'] = $userData['role'];

        // Redirect based on role
        if ($_SESSION['role'] === "admin") {
            header("Location:../views/admin/admin_dashboard.php");
        } else {
            header("Location: ../views/user/dashboard.php");
        }
        exit;
    } else {
        header("Location: ../views/auth/login.php?error=1");
        exit;
    }
}

/* ===============================
   🔹 Handle Logout
   =============================== */
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../views/auth/login.php");
    exit;
}
