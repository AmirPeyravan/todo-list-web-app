<?php
include("../tools/userManagement/accessories.php")
?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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

        .btn-primary {
            background-color: #007bff;
            border: none;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>ورود به حساب کاربری</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="login-username" class="form-label">نام کاربری :</label>
                <input name="username" type="text" class="form-control" id="login-username" required>
            </div>
            <div class="mb-3">
                <label for="login-password" class="form-label">رمز عبور :</label>
                <input name="password" type="password" class="form-control" id="login-password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">ورود به حساب کاربری</button>
            <hr>
            <button type="button" onclick="window.location.href='register.html.php'" class="btn btn-success w-100">حساب ندارید ؟ ثبت نام کنید</button>
            <hr>
            <button type="button" onclick="window.location.href='http://localhost/todo-php'" class="btn btn-light w-100">بازگشت</button>
        </form>
    </div>
</body>

</html>
<?php

$check = new Accessories();
$check->checkUserStatus();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $pdo = new PDO('mysql:dbname=if0_38474048_todo_db;host=sql108.infinityfree.com', 'if0_38474048', 'iK4oIFnxM3C8');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $statement = $pdo->prepare("SELECT * FROM userslist WHERE username = :username");
        $statement->bindParam(':username', $username, type: PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            if (password_verify($password, $user['password'])) {

                $_SESSION['useraccount'] = $username;
                header("location:http://localhost/todo-php/");
            } else {
                echo "<script>alert('password invalid...')</script>";
            }
        } else {
            echo "<script>alert('user not found...')</script>";
        }
    } catch (Exception $e) {
        echo "error: " . $e->getMessage();
    }
}


?>
