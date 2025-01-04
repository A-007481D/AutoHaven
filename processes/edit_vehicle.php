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
// move images to folder 


if ($_POST['type'] === 'availability') {
    $vehicles = $vehicle->editVehicleAvailability($_POST['vehicleID'], $_POST['availability']);
    header("Location: ../pages/vehiclesDash.php");

    
} else {
    if ($_FILES['image']['size'])  {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name']; 
        $uploadDir = '../img/';
        $uniqueFileName = uniqid() . '-' . $fileName;
        $destPath = $uploadDir . $uniqueFileName;
        $var = move_uploaded_file($fileTmpPath, $destPath);
        // print_r($_FILES['image']);
    } else {
        $uniqueFileName = NULL;
        $var = true;
    }
    
    if ($var) {
        // echo "File uploaded successfully: " . $destPath;
        try {
            $vehicles = $vehicle->editVehicle($_POST['vehicleID'], $_POST['model'], 
            $_POST['brand'], 
            $_POST['categoryID'], 
            $_POST['price'], 
            $_POST['description'], 
            $uniqueFileName, 
            $_POST['fuel'], 
            $_POST['seats'], 
            $_POST['doors'], 
            $_POST['features']); 
            header("Location: ../pages/vehiclesDash.php");
        } catch (PDOException  $ex) {
            die("Edit vehicle failed: " . $ex->getMessage());
        }
        
    } else {
        echo "Error moving the file to the upload directory.";
    }
    
    
}




?>