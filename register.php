<?php
require_once "Database.php"; // Подключаем класс Database

// Создаём объект базы данных
$db = new Database();
$pdo = $db->connect($host, $user, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST["login"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = trim($_POST["email"]);

    try {
        // 1. Проверяем, есть ли уже такой логин
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM Users WHERE login = ?");
        $stmt->execute([$login]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo "Ошибка: логин уже занят!";
        } else {
            // 2. Если логин свободен, выполняем регистрацию
            $stmt = $pdo->prepare("INSERT INTO Users (login, password, email) VALUES (?, ?, ?)");
            $stmt->execute([$login, $password, $email]);
            echo "Регистрация успешна!";
        }
    } catch (PDOException $e) {
        echo "Ошибка регистрации: " . $e->getMessage();
    }
}
?>
