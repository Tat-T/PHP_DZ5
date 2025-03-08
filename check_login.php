<?php
require_once "Database.php"; // Подключение к базе

if (isset($_GET["login"])) {
    $login = trim($_GET["login"]);

    $pdo = connect($host, $user, $password, $dbname);

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Users WHERE login = ?");
    $stmt->execute([$login]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo json_encode(["status" => "error", "message" => "Логин уже занят"]);
    } else {
        echo json_encode(["status" => "success", "message" => "Логин свободен"]);
    }
}
?>
