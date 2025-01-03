<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../classes/Database.class.php';
require_once '../classes/Category.class.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/fleet.php");
    exit;
}

$db = new Database();
$dbcon = $db->getConnection();
$category = new  Category($dbcon);

try {
    $categories = $category->addCategory($_POST['categoryName']);
    header("Location: ../pages/categoryDash.php");
} catch (PDOException  $ex) {
    die("Add category failed: " . $ex->getMessage());
}



?>