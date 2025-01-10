<?php
// Start session if not already started
session_start();

// Include necessary files
require_once '../../classes/Comment.class.php';
require_once '../../classes/Database.class.php';
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addComment'])) {

    $userID = $_SESSION['userID'] ?? null;

    if (!$userID) {
        die('Error: User not logged in.');
    }

    // Get the article ID (assumes it's passed, update logic as needed)
    $articleID = $_POST['articleID'] ?? null;

    if (!$articleID) {
        die('Error: Article ID not provided.');
    }

    // Get the comment text
    $commenter = trim($_POST['comment']);

    if (empty($commenter)) {
        die('Error: Comment cannot be empty.');
    }

    // Instantiate Comment and add the comment
    try {

        $comment = new Comment($db->getConnection());


        $success = $comment->addComment($userID, $articleID, $commenter);


        if ($success) {

            header('Location: ../../pages/view_article.php?articleID=' . $articleID . '&message=Comment added successfully');
            exit;
        } else {
            die('Error: Failed to add comment.');
        }
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
} else {
    die('Invalid request.');
}
