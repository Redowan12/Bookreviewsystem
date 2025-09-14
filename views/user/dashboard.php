<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php?unauthorized=1");
    exit;
}

require_once "../../config/database.php";
require_once __DIR__ . "/../../controllers/BookController.php";

$database = new Database();
$db = $database->getConnection();

// Initialize BookController
$controller = new BookController($db);
$data = $controller->getDashboardData($_GET, $_POST, $_SESSION['user_id']);

$categories = $data['categories'];
$books = $data['books'];
$search_query = $data['search_query'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>BookVerse - Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/user_dashboard.css">
</head>
<body>

<header>
    <h1>BookVerse</h1>
    <div class="header-buttons">

        <!-- Search form -->
        <form method="GET">
            <input type="text" name="search" placeholder="Search books..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Category dropdown -->
        <div class="category-wrapper">
            <a href="#" class="category-btn">Category ▼</a>
            <div class="category-dropdown">
                <a href="dashboard.php">All Books</a>
                <?php foreach($categories as $cat): ?>
                    <a href="dashboard.php?category=<?php echo $cat['id']; ?>">
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Community button -->
        <a class="community-btn" href="community.php">Community</a>

        <!-- Logout button -->
        <a class="logout-btn" href="../../controllers/UserController.php?logout=1">Logout</a>
    </div>
</header>

<div class="container">
    <div class="book-list">
        <?php foreach($books as $book): ?>
            <div class="book-card" onclick="openModal(<?php echo $book['id']; ?>)">
                <img src="../../uploads/<?php echo !empty($book['image']) ? $book['image'] : 'no-image.png'; ?>" 
                     alt="<?php echo htmlspecialchars($book['title']); ?>">
                <div class="book-info">
                    <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                    <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                    <p><strong>Rating:</strong> <?php echo $book['avg_rating']; ?> ⭐ (<?php echo $book['total_reviews']; ?> reviews)</p>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal" id="modal-<?php echo $book['id']; ?>">
                <span class="close-btn" onclick="closeModal(<?php echo $book['id']; ?>)">&times;</span>
                <div class="modal-content">
                    <div class="modal-left">
                        <img src="../../uploads/<?php echo !empty($book['image']) ? $book['image'] : 'no-image.png'; ?>" 
                             alt="<?php echo htmlspecialchars($book['title']); ?>">
                    </div>
                    <div class="modal-right">
                        <h2><?php echo htmlspecialchars($book['title']); ?></h2>
                        <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                        <p><?php echo htmlspecialchars($book['description']); ?></p>
                        <p><strong>Avg Rating:</strong> <?php echo $book['avg_rating']; ?> ⭐ (<?php echo $book['total_reviews']; ?> reviews)</p>

                        <!-- Review Form -->
                        <form method="POST" class="review-form">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <select name="rating" required>
                                <option value="">Rate this book</option>
                                <option value="1">1 ⭐</option>
                                <option value="2">2 ⭐</option>
                                <option value="3">3 ⭐</option>
                                <option value="4">4 ⭐</option>
                                <option value="5">5 ⭐</option>
                            </select>
                            <textarea name="review" placeholder="Write your review..." required></textarea>
                            <button type="submit" name="submit_review">Submit Review</button>
                        </form>

                        <!-- Other Users Reviews -->
                        <h4>Reviews by others:</h4>
                        <?php $reviews = $controller->getReviews($book['id']); ?>
                        <?php if(count($reviews) > 0): ?>
                            <?php foreach($reviews as $rev): ?>
                                <div class="review-card">
                                    <strong><?php echo htmlspecialchars($rev['username']); ?></strong> ⭐ <?php echo $rev['rating']; ?><br>
                                    <?php echo htmlspecialchars($rev['review_text']); ?><br>
                                    <small><?php echo $rev['created_at']; ?></small>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No reviews yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>

<script src="../../assets/js/user_dashboard.js"></script>
</body>
</html>
