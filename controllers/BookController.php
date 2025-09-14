<?php
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../models/Review.php';

class BookController {
    private $bookModel;
    private $reviewModel;

    public function __construct($db) {
        $this->bookModel = new Book($db);
        $this->reviewModel = new Review($db);
    }

    /**
     * Get data for user dashboard
     * @param array $get - $_GET parameters
     * @param array $post - $_POST parameters
     * @param int $user_id - current logged-in user id
     * @return array - ['books'=>..., 'categories'=>..., 'search_query'=>...]
     */
    public function getDashboardData($get, $post, $user_id) {
        $search_query = $get['search'] ?? '';
        $category_filter = $get['category'] ?? null;

        // Handle review submission
        if(isset($post['submit_review'])) {
            $book_id = $post['book_id'];
            $rating = $post['rating'];
            $review_text = $post['review'];

            // Save review
            $this->reviewModel->addReview($book_id, $user_id, $rating, $review_text);

            // Reload page to show new review
            header("Location: dashboard.php");
            exit;
        }

        // Fetch books and categories
        $books = $this->bookModel->getBooks($search_query, $category_filter);
        $categories = $this->bookModel->getCategories();

        return [
            'books' => $books,
            'categories' => $categories,
            'search_query' => $search_query
        ];
    }

    /**
     * Get all reviews for a book
     */
    public function getReviews($book_id) {
        return $this->reviewModel->getReviewsByBook($book_id);
    }

    /**
     * Add a new book
     */
    public function addBook($title, $author, $description, $image, $category_id) {
        return $this->bookModel->addBook($title, $author, $description, $image, $category_id);
    }

    /**
     * Get book details by ID
     */
    public function getBook($book_id) {
        return $this->bookModel->getBookById($book_id);
    }

    /**
     * Delete a book
     */
    public function deleteBook($book_id) {
        return $this->bookModel->deleteBook($book_id);
    }
}
