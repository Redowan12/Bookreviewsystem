<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: views/auth/admin_dashboard.php");
        exit;
    } else {
        header("Location: views/user/dashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>BookVerse - Discover Your Next Read</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <div class="content">
            <h1>BookVerse</h1>
            <p>Discover, Review, and Share Your Favorite Books</p>
            <div class="btn-wrapper">
                <a href="views/auth/login.php" class="btn">Login</a>
                <a href="views/auth/signup.php" class="btn btn-outline">Sign Up</a>
            </div>
        </div>
        
            <img src="uploads/index.jpg" >
        </div>
    </div>
    <script src="assets/js/index.js"></script>
</body>
</html>
