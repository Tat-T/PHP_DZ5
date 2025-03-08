<?php
require_once "Database.php"; // Подключаем базу

if (isset($_GET["login"])) {
    $login = trim($_GET["login"]);

    $db = new Database();
    $pdo = $db->connect($host, $user, $password, $dbname);

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Users WHERE login = ?");
    $stmt->execute([$login]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo json_encode(["status" => "error", "message" => "❌ Логин уже занят"]);
    } else {
        echo json_encode(["status" => "success", "message" => "✅ Логин свободен"]);
    }
}
?>
