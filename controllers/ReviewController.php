<?php
session_start();
require_once "../config/database.php";

// Check session
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit;
}

class ReviewController {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function submitReview($book_id, $user_id, $rating, $review) {
        $stmt = $this->db->prepare("INSERT INTO reviews (book_id, user_id, rating, review) VALUES (?, ?, ?, ?)");
        $stmt->execute([$book_id, $user_id, $rating, $review]);

        header("Location: ../views/user_dashboard.php?success=1");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ReviewController();
    $controller->submitReview($_POST['book_id'], $_SESSION['user_id'], $_POST['rating'], $_POST['review']);
}
