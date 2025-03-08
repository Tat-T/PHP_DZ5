<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Регистрация</title>
</head>

<body>

    <div class="container mt-5">
        <div class="row m-3">
            <h2 class="text-info">Форма регистрации</h2>
        </div>
        <form method="POST" action="register.php" class="container col-6 rounded p-3 mt-3 position-absolute top-50 start-50 translate-middle shadow-lg">
            <!-- <form method="POST" action="register.php" class="container col-6 rounded p-3 mt-3 shadow-lg"> -->
            <div class="row mt-3">
                <div class="col-3"><label class="form-label" for="login">Логин:</label></div>
                <div class="col-9">
                    <div><input id="login" class="form-control border border-primary focus-ring focus-ring-primary" type="text" name="login" required></div>
                    <div id="login-message" class="mt-1"></div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-3"><label class="form-label" for="password">Пароль:</label></div>
                <div class="col-9"><input id="password" class="form-control border border-primary focus-ring focus-ring-primary" type="password" name="password" required></div>
            </div>
            <div class="row mt-3">
                <div class="col-3"><label class="form-label" for="email">Email:</label></div>
                <div class="col-9"><input id="email" class="form-control border border-primary focus-ring focus-ring-primary" type="email" name="email" required></div>
            </div>
            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#login").on("input", function() {
                let login = $(this).val().trim();
                let messageBox = $("#login-message");

                if (login.length === 0) {
                    messageBox.html(""); // Очищаем сообщение, если поле пустое
                    return;
                }

                if (login.length < 5) {
                    messageBox.html('<span class="text-danger">Логин слишком короткий</span>');
                    return;
                } else {
                    messageBox.html(""); //Скрываем ошибку, если логин стал длиннее 3 символов
                }

                $.ajax({
                    url: "check_login.php",
                    type: "GET",
                    data: {
                        login: login
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "error") {
                            messageBox.html('<span class="text-danger">' + response.message + '</span>');
                        } else {
                            messageBox.html('<span class="text-success">' + response.message + '</span>');
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>