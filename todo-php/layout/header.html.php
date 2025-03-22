<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['useraccount'])){
    $username = $_SESSION['useraccount'];
}

$pdo = new PDO('mysql:dbname=todo_db;host=localhost', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $pdo->prepare("SELECT * FROM userslist WHERE username = :username");
$statement->bindParam(':username', $username, PDO::PARAM_STR);
$statement->execute();
$tasks = $statement->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>خانه</title>

    <link href="layout/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="wrapper">

        <header class="bg-dark py-3">
            <div class="container d-flex justify-content-between align-items-center">
                <h3 id="txtHeader" onclick="window.location.href='http://localhost/todo-php/'" class="text-light">لیست انجام کار</h3>
                <div>
                    <button onclick="window.location.href='http://localhost/todo-php/todo/add.php'" class="btn btn-outline-primary me-2">افزودن</button>
                    <?php
                    if (isset($_SESSION['useraccount'])) {
                        echo "<button class='btn btn-outline-light me-2' onclick=\"window.location.href='http://localhost/todo-php/users/panel.php?id={$tasks['userId']}'\">{$_SESSION['useraccount']}</button>";
                        echo "<button class='btn btn-danger' onclick=\"window.location.href='http://localhost/todo-php/auth/logout.php'\">خروج</button>";
                    } else {
                        echo "<button class='btn btn-outline-light' onclick=\"window.location.href='http://localhost/todo-php/auth/login.html.php'\">ورود</button>";
                        echo " ";
                        echo "<button class='btn btn-outline-success' onclick=\"window.location.href='http://localhost/todo-php/auth/register.html.php'\">ثبت نام</button>";
                    }
                    ?>
                </div>
            </div>
        </header>