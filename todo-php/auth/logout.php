<?php
session_start();

$result = $_SESSION['useraccount'];

function logOut(string $username)
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        if (isset($_SESSION['useraccount']) && $_SESSION['useraccount'] === $username) {
            session_unset();
            session_destroy();
            header("Location: http://localhost/todo-php/auth/login.html.php");
            exit();
        }
    }
}
logOut($result);
?>

