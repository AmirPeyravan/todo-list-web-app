<?php
include("../tools/userManagement/accessories.php")
?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Vazir;
        }

        .form-container {
            width: 400px;
            padding: 20px;
            background: #212529;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #f8f9fa;
        }

        .form-control {
            background: #495057;
            color: white;
            border: none;
        }

        .form-control:focus {
            background: #6c757d;
            color: white;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>ایجاد حساب کابری</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="register-username" class="form-label">نام کاربری :</label>
                <input name="username" type="text" class="form-control" id="register-username" required>
            </div>
            <div class="mb-3">
                <label for="register-password" class="form-label">رمز عبور :</label>
                <input name="password" type="password" class="form-control" id="register-password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">ساخت حساب</button>
            <hr>
            <button type="button" onclick="window.location.href='login.html.php'" class="btn btn-primary w-100">حساب دارید ؟ وارد شوید</button>
            <hr>
            <button type="button" onclick="window.location.href='http://localhost/todo-php'" class="btn btn-light w-100">بازگشت</button>

        </form>
    </div>
</body>

</html>

<?php

$accessory = new Accessories();
$accessory->checkUserStatus();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        $pdo = new PDO('mysql:dbname=if0_38474048_todo_db;host=sql108.infinityfree.com', 'if0_38474048', 'iK4oIFnxM3C8');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $statement = $pdo->prepare('INSERT INTO userslist (username, password) 
                                VALUES (:username, :password)');
        $result = $statement->execute(
            [
                'username' => $username,
                'password' => $hashedPassword
            ]
        );

        if ($result) {
            $_SESSION['useraccount'] = $username;
            header("location:http://localhost/todo-php/");
        }
    } catch (Exception $e) {
        echo "erorr: " . $e->getMessage();
    }
}

?>