<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_SESSION['useraccount'])){

        $id = $_GET['id'];

        $pdo = new PDO('mysql:dbname=if0_38474048_todo_db;host=sql108.infinityfree.com', 'if0_38474048', 'iK4oIFnxM3C8');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $statement = $pdo->prepare("DELETE FROM todolist WHERE todoId = :id");
        $statement->bindParam(':id', $id, type: PDO::PARAM_STR);
        $statement->execute();

        header("location:http://localhost/todo-php/");
        exit();
    }
}

?>