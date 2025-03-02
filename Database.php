<?php
$host = "DESKTOP-NKNKVEQ\\SQLEXPRESS";
$user = "";  // Windows-аутентификация
$password = "";
$dbname = "DZ_5";

class Database
{
    private $connection;

    public function connect($host, $user, $password, $dbname) {
        try {
            $dsn = "sqlsrv:Server=$host;Database=$dbname";
            $this->connection = new PDO($dsn, $user, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Ошибка подключения: " . $e->getMessage());
        }
        return $this->connection;
    }

    public function getCountries()
    {
        $sql = "SELECT id, country FROM Countries ORDER BY country";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
