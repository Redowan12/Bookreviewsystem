<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php?unauthorized=1");
    exit;
}

require_once "../../config/database.php";
$database = new Database();
$db = $database->getConnection();

// Fetch categories
$cat_stmt = $db->query("SELECT * FROM categories");
$categories = $cat_stmt->fetchAll(PDO::FETCH_ASSOC);

// Add book
if (isset($_POST['add_book'])) {
    require_once "../../controllers/AdminController.php";
    $controller = new AdminController($db);
    $controller->addBook($_POST, $_FILES);
}

// Delete book
if (isset($_GET['delete'])) {
    require_once "../../controllers/AdminController.php";
    $controller = new AdminController($db);
    $controller->deleteBook($_GET['delete']);
}

// Fetch books
$book_stmt = $db->query("SELECT b.*, c.name AS category_name FROM books b LEFT JOIN categories c ON b.category_id = c.id ORDER BY b.created_at DESC");
$books = $book_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/admin_dashboard.css">
</head>
<body>
    <header>
        <div>
            <h1>Admin Dashboard</h1>
        </div>
        <div class="top-nav">
            <a href="#">Category</a>
            <a href="#">Community</a>
            <a class="logout" href="../../controllers/UserController.php?logout=1">Logout</a>
        </div>
    </header>

    <div class="container">
        <h2>Add New Book</h2>
        <form method="POST" enctype="multipart/form-data" id="add-book-form">
            <input type="text" name="title" placeholder="Book Title" required>
            <input type="text" name="author" placeholder="Author" required>
            <textarea name="description" placeholder="Book Description" required></textarea>
            <select name="category_id" required>
                <option value="">Select Category</option>
                <?php foreach($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="file" name="book_image" accept="image/*" required>
            <button type="submit" name="add_book">Add Book</button>
        </form>

        <h2>Book List</h2>
        <div class="book-list">
            <?php foreach ($books as $book): ?>
                <div class="book-card">
                    <img src="../uploads/<?php echo !empty($book['image']) ? $book['image'] : 'no-image.png'; ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                    <div class="book-info">
                        <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                        <p><?php echo htmlspecialchars($book['author']); ?></p>
                        <p>Category: <?php echo htmlspecialchars($book['category_name']); ?></p>
                    </div>
                    <a href="admin_dashboard.php?delete=<?php echo $book['id']; ?>">Delete</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="../../assets/js/admin_dashboard.js"></script>
</body>
</html>
