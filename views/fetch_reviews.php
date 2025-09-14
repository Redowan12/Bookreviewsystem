<?php
require_once "../config/database.php";
require_once "../models/Review.php";

$db = (new Database())->getConnection();
$reviewModel = new Review($db);

if(isset($_GET['book_id'])) {
    $reviews = $reviewModel->getByBook($_GET['book_id']);
    if($reviews) {
        foreach($reviews as $rev) {
            echo "<div style='border-bottom:1px solid #ccc; margin:10px 0; padding:5px;'>";
            echo "<strong>".htmlspecialchars($rev['username'])."</strong> rated ".$rev['rating']."★<br>";
            echo "<p>".htmlspecialchars($rev['review'])."</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No reviews yet. Be the first!</p>";
    }
}
