<?php 

require_once './classes/Database.class.php';

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

    public function register(string $F_name, string $L_name, string $email, string $password): bool {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $this->dbcon->prepare("INSERT INTO users (first_name, last_name, email, password) 
                                            VALUES (:F_name, :L_name, :email_reg, :password_reg)");
            $stmt->bindParam(':F_name', $F_name);
            $stmt->bindParam(':L_name', $L_name);
            $stmt->bindParam(':email_reg', $email);
            $stmt->bindParam(':password_reg', $hashedPassword);
            $stmt->execute();
            return true; 
        } catch (PDOException $ex) {
            echo "Registration failed: " . $ex->getMessage();
            return false;
        }
    }
    
    public function login(string $email, string $password):bool {
        try {
            $stmt = $this->dbcon->prepare("SELECT * FROM users WHERE email = :email_login");
            $stmt->bindParam(':email_login', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['userID'] = $user['userID']; 
                $_SESSION['role'] = $user['role']; 

                if ($user['role'] === 'admin') {
                    header("Location: ../pages/adminDash.php");
                } elseif ($user['role'] === 'client') {
                    header("Location: ../pages/clientProfile.php"); 
                } else {
                    header("Location : ../pages/login.php");
                }
                exit();
            } else {
                return false; 
            }
        } catch (PDOException $ex) {
            echo "Login failed: " . $ex->getMessage();
            return false;
        }
    }



    public function logout():void{
        session_unset();
        session_destroy();
        header("Location : ../pages/login.php");
        exit();
    }




}

?>