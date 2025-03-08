<?php 
$host = "DESKTOP-NKNKVEQ\\SQLEXPRESS";
$user = "";
$password = "";
$dbname = "DZ_5";

class Database
{
    public $connection;

    public function connect($host, $user, $password, $dbname) {
        try {
            $dsn = "sqlsrv:Server=$host;Database=$dbname";
            $this->connection = new PDO($dsn, $user, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Запускаем миграцию сразу после подключения
            $this->migrate();

        } catch (PDOException $e) {
            die("Ошибка подключения: " . $e->getMessage());
        }
        return $this->connection;
    }

    private function migrate() {
        $sql = "IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='Users' AND xtype='U')
                CREATE TABLE Users (
                    id INT IDENTITY(1,1) PRIMARY KEY,
                    login NVARCHAR(50) UNIQUE NOT NULL,
                    password NVARCHAR(255) NOT NULL,
                    email NVARCHAR(100) UNIQUE NOT NULL,
                    created_at DATETIME DEFAULT GETDATE()
                )";

        try {
            $this->connection->exec($sql);
            echo " Таблица Users успешно создана (или уже существует).<br>";
        } catch (PDOException $e) {
            echo " Ошибка миграции: " . $e->getMessage();
        }
    }
}
