<?php
session_start();

class Accessories
{
    public function checkUserStatus()
    {
        if (isset($_SESSION['useraccount'])) {
            header("Location: http://localhost/todo-php");
        }
    }
}
