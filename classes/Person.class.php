<?php 
require_once '.././classes/Database.class.php';

abstract class Person {
    protected int $id;
    protected string $F_name;
    protected string $L_name;
    protected string $email;
    protected string $password;
    protected int $role;
    protected PDO $dbcon;

    public function __construct(PDO $dbcon)
    {
        $this->dbcon = $dbcon;
    }
  
    abstract public function register(string $F_name, string $L_name, string $email, string $password): bool;

    abstract public function login(string $email, string $password): bool;

    public function logout():void {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../pages/login.php");
        exit();
    }
    
}

?>
