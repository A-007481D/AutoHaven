<?php 
require_once '.././classes/Database.class.php';
require_once '.././classes/Client.class.php';
require_once '.././classes/Admin.class.php';

$db = new Database();
$dbcon = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email_login'], $_POST['password_login'])) {
        $email = trim($_POST['email_login']);
        $password = trim($_POST['password_login']);

        $client = new Client($dbcon);
        $admin = new Admin($dbcon);

        if ($admin->login($email, $password)) {
            exit; 
        }
        if ($client->login($email, $password)) {
            exit; 
        } 
        
        echo "Invalid login credentials.";
    } elseif (isset($_POST['email_reg'], $_POST['password_reg'], $_POST['F_name'], $_POST['L_name'])) {
        $F_name = trim($_POST['F_name']);
        $L_name = trim($_POST['L_name']);
        $email = trim($_POST['email_reg']);
        $password = trim($_POST['password_reg']);

        $client = new Client($dbcon);

        if ($client->register($F_name, $L_name, $email, $password)) {
            echo "Registration successful!";
        } else {
            echo "Registration failed.";
        }
    }
}
?>
