<?php 
require_once './classes/Database.class.php';
require_once './classes/Person.class.php';

$db = new Database();
$dbcon = $db->getConnection();

$person = new Person($dbcon);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email_login'], $_POST['password_login'])) {
        $email = trim($_POST['email_login']);
        $password = trim($_POST['password_login']);

        if ($person->login($email, $password)) {
            header('Location: ../pages/index.php');
        } else {
            echo "Invalid login credentials.";
        }
    } elseif (isset($_POST['email_reg'], $_POST['password_reg'], $_POST['F_name'], $_POST['L_name'])) {
        $F_name = trim($_POST['F_name']);
        $L_name = trim($_POST['L_name']);
        $email = trim($_POST['email_reg']);
        $password = trim($_POST['password_reg']);

        if ($person->register($F_name, $L_name, $email, $password)) {
            header('Location: ../pages/login.php?success=1');
        } else {
            echo "Registration failed.";
        }
    }
}
?>
