<?php
class AdminController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Add a new book
    public function addBook($post, $files) {
        $title = $post['title'];
        $author = $post['author'];
        $description = $post['description'];
        $category_id = $post['category_id'];

        // Handle image upload
        $image_name = null;
        if(isset($files['book_image']) && $files['book_image']['error'] === 0){
            $image_name = time().'_'.$files['book_image']['name'];
            $target_dir = "../uploads/";
            if(!file_exists($target_dir)){
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . $image_name;
            move_uploaded_file($files['book_image']['tmp_name'], $target_file);
        }

        $stmt = $this->db->prepare("INSERT INTO books (title, author, description, category_id, image) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$title, $author, $description, $category_id, $image_name]);
    }

    // Delete a book
    public function deleteBook($book_id) {
        // Delete book image if exists
        $stmt = $this->db->prepare("SELECT image FROM books WHERE id = ?");
        $stmt->execute([$book_id]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if($book && !empty($book['image'])){
            $file_path = "../uploads/" . $book['image'];
            if(file_exists($file_path)) unlink($file_path);
        }

        // Delete book record
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = ?");
        return $stmt->execute([$book_id]);
    }
}
?>
