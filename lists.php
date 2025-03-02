<?php
require_once "Database.php";

$db = new Database();
$conn = $db->connect("DESKTOP-NKNKVEQ\\SQLEXPRESS", "", "", "DZ_5");

$countries = $db->getCountries();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Выбор страны</title>
</head>
<body class="bg-primary-subtle">

<div class="container mt-5">
    <form action="" method="post" class="col-6 p-3 mt-3">
        <label for="country" class="fw-bold">Выберите страну:</label>
        <select name="country" id="country">
            <option value="">-- Выберите страну --</option>
            <?php foreach ($countries as $country): ?>
                <option value="<?= $country['id'] ?>"><?= htmlspecialchars($country['country']) ?></option>
            <?php endforeach; ?>
        </select>
    </form>
    <div class="d-grid" id="cities"></div> 
</div>


<script>
$(document).ready(function() {
    $("#country").change(function() {
        let countryId = $(this).val();
        if (countryId) {
            $.ajax({
                url: "get_cities.php",
                type: "GET",
                data: { country_id: countryId },
                success: function(data) {
                    $("#cities").html(data);
                }
            });
        } else {
            $("#cities").html("");
        }
    });
});
</script>
</body>
</html>
