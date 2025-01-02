<?php
require_once '.././classes/Person.class.php';


class Client extends Person {
    public function register(string $F_name, string $L_name, string $email, string $password):bool {
        try {
            $stmt = $this->dbcon->prepare("INSERT INTO users (first_name, last_name, email, password) 
                                            VALUES (:F_name, :L_name, :email, :password)");
            $stmt->bindParam(':F_name', $F_name);
            $stmt->bindParam(':L_name', $L_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            echo "registration failed: " . $ex->getMessage();
            return false;
        }
    }

    public function login(string $email, string $password):bool {
        try {
            $stmt = $this->dbcon->prepare("SELECT * FROM users WHERE email = :email AND role = 'client'");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['role'] = $user['role'];
                header("Location: ../pages/clientProfile.php");
                return true;
            }

            return false;
        } catch (PDOException $ex) {
            echo "login failed: " . $ex->getMessage();
            return false;
        }
    }
}
?>
