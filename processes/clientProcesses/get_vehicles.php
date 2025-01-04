<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../classes/Database.class.php';
require_once '../classes/Vehicle.class.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/fleet.php");
    exit;
}

$db = new Database();
$dbcon = $db->getConnection();
$vehicle = new  Vehicle($dbcon);

try {
    $getvehicle = $vehicle->getAllActiveVehicles();
    echo json_encode($getvehicle);
} catch (PDOException  $ex) {
    die("Add category failed: " . $ex->getMessage());
}



?>