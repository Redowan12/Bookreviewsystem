<?php
class Review {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function addReview($book_id, $user_id, $rating, $review_text){
        $stmt = $this->db->prepare("INSERT INTO reviews (book_id, user_id, rating, review_text, created_at) VALUES (?, ?, ?, ?, NOW())");
        return $stmt->execute([$book_id, $user_id, $rating, $review_text]);
    }

    public function getReviewsByBook($book_id){
        $stmt = $this->db->prepare("SELECT r.*, u.username FROM reviews r JOIN users u ON r.user_id=u.id WHERE r.book_id=? ORDER BY r.created_at DESC");
        $stmt->execute([$book_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
