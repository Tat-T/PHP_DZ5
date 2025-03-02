<?php
require_once "Database.php";

if (isset($_GET['country_id'])) {
    $country_id = intval($_GET['country_id']);

    $db = new Database();
    $conn = $db->connect("DESKTOP-NKNKVEQ\\SQLEXPRESS", "", "", "DZ_5");

    $stmt = $conn->prepare("SELECT city FROM Cities WHERE countryid = ?");
    $stmt->execute([$country_id]);
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($cities) {
        echo "<div class='container mt-3'>";
        echo "<div class='d-flex flex-column rounded p-3'>";
        foreach ($cities as $city) {
            echo "<div class='p-2 border-bottom border-dark'>" . htmlspecialchars($city['city']) . "</div>";
        }
        echo "</div>";
        echo "</div>";
    } else {
        echo "<p class='text-muted'>Нет данных</p>";
    }
}
?>
