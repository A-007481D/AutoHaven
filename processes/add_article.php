<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../classes/Database.class.php';
require_once '../classes/Article.class.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'client' && $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}

$db = new Database();
$article = new Article($db->getConnection());

//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    echo '<pre>';
//    print_r($_POST);
//    print_r($_FILES);
//    echo '</pre>';
//    exit;
//}

if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['themeID'])) {
    die("All fields are required.");
}

$fileTmpPath = $_FILES['image']['tmp_name'];
$fileName = $_FILES['image']['name'];
$uploadDir = '../img/';
$uniqueFileName = uniqid() . '-' . $fileName;
$destPath = $uploadDir . $uniqueFileName;

if (move_uploaded_file($fileTmpPath, $destPath)) {
    try {
        $userID = $_SESSION['userID']; 
        $articleID = $article->addArticle(
            $_POST['title'],
            $_POST['content'],
            $uniqueFileName,
            $_POST['themeID'],
            $userID
        );


        if (!empty($_POST['tags'])) {
            foreach ($_POST['tags'] as $tagID) {
                $article->addArticleTag($articleID, $tagID);
            }
        }

        header("Location: ../pages/index.php");
    } catch (PDOException $ex) {
        die("Add article failed: " . $ex->getMessage());
    }
} else {
    die("Error moving the file to the upload directory.");
}