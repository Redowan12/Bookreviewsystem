<?php
class Book {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Get all books with avg rating and total reviews
    public function getBooks($search = '', $category = null) {
        $sql = "SELECT b.*, IFNULL(ROUND(AVG(r.rating),1), 'No Ratings') AS avg_rating, COUNT(r.id) AS total_reviews
                FROM books b
                LEFT JOIN reviews r ON b.id = r.book_id";
        $params = [];
        $where = [];

        if($search) {
            $where[] = "(b.title LIKE ? OR b.author LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        if($category) {
            $where[] = "b.category_id = ?";
            $params[] = $category;
        }

        if($where) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $sql .= " GROUP BY b.id ORDER BY b.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get categories
    public function getCategories() {
        $stmt = $this->db->query("SELECT * FROM categories ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get single book by ID
    public function getBookById($id) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add new book
    public function addBook($title, $author, $description, $image, $category_id) {
        $stmt = $this->db->prepare("INSERT INTO books (title, author, description, image, category_id) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$title, $author, $description, $image, $category_id]);
    }

    // Delete book
    public function deleteBook($id) {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
