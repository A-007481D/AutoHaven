<?php 



class Database {
    private $host = "localhost";
    private $user = "root";
    private $pwd = "abdelmalek";
    private $dbname = "autohaven";
    private $connection;

    public function __construct($host, $user,$pwd,$dbname)
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4";
        try {
            $this->connection = new PDO($dsn, $this->user, $this->pwd);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException  $ex) {
            die ("Connection failed: " . $ex->getMessage());
        }
    }


    public function getConnection()
    {
        return $this->connection;
    }
}


?>