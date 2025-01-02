<?php 



class Database {
    private string $host = "localhost";
    private string $user = "root";
    private string $pwd = "abdelmalek";
    private string $dbname = "autohaven";
    private PDO $connection;

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4";
        try {
            $this->connection = new PDO($dsn, $this->user, $this->pwd);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException  $ex) {
            die ("Connection failed: " . $ex->getMessage());
        }
    }


    public function getConnection(): PDO
    {
        return $this->connection;
    }
}


?>