<?php session_start();?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>افزودن</title>
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
        <h2>ایجاد تسک جدید</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="register-username" class="form-label">عنوان تسک :</label>
                <input name="todoName" type="text" class="form-control" id="register-username" required>
            </div>
            <div class="mb-3">
                <label for="register-password" class="form-label">توضیحات :</label>
                <textarea name="description" class="form-control" id="register-password" required></textarea>
            </div>
            <button type="submit" class="btn btn-success w-100">ایجاد تسک</button>
            <hr>
            <button type="button" onclick="window.location.href='http://localhost/todo-php'" class="btn btn-light w-100">بازگشت</button>
        </form>
    </div>
</body>

</html>

<?php
if (!isset($_SESSION['useraccount'])) {
    header("Location: http://localhost/todo-php/auth/login.html.php");
    exit();
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        $pdo = new PDO('mysql:dbname=if0_38474048_todo_db;host=sql108.infinityfree.com', 'if0_38474048', 'iK4oIFnxM3C8');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $todoName = $_POST['todoName'];
        $todoDescription = $_POST['description'];
        $createdAt = date('Y-m-d H:i:s');
        $username = $_SESSION['useraccount'];

        $statement = $pdo->prepare('INSERT INTO todolist (todoName, todoDescription,createdAt,username) 
                                VALUES (:todoName, :todoDescription,:createdAt,:username)');
        $result = $statement->execute(
            [
                'todoName' => $todoName,
                'todoDescription' => $todoDescription,
                'createdAt' => $createdAt,
                'username' => $username
            ]
        );

        if ($result) {
            header("location:http://localhost/todo-php/");
            exit();
        }
    } catch (Exception $e) {
        echo "erorr: " . $e->getMessage();
    }
}
?>