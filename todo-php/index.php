<?php
session_start();
include("Layout/header.html.php");
?>

    <body class="bg-dark text-light">
    <main class="container my-5 content">
        <h2 class="text-center">
            <div class="container my-5">
                <table class="table table-dark table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام تسک</th>
                        <th>توضیحات</th>
                        <th>تاریخ ثبت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!isset($_SESSION['useraccount'])) {
                        echo "<div class='alert alert-danger' role='alert'><h4>برای دسترسی به داده های خود ابتدا وارد شوید</h4></div>";
                    } else {
                        $username = $_SESSION['useraccount'];

                        try {
                            $pdo = new PDO('mysql:dbname=if0_38474048_todo_db;host=sql108.infinityfree.com', 'if0_38474048', 'iK4oIFnxM3C8');
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $statement = $pdo->prepare("SELECT * FROM todolist WHERE username = :username");
                            $statement->bindParam(':username', $username, PDO::PARAM_STR);
                            $statement->execute();
                            $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

                            if ($tasks) {
                                foreach ($tasks as $task) {
                                    echo "<tr>";
                                    echo "<td>{$task['todoId']}</td>";
                                    echo "<td>{$task['todoName']}</td>";
                                    echo "<td>{$task['todoDescription']}</td>";
                                    echo "<td>{$task['createdAt']}</td>";
                                    echo "<td>";
                                    echo "<button class='btn btn-outline-warning btn-sm' onclick=window.location.href='http://localhost/todo-php/todo/edite.php?id={$task['todoId']}'>ویرایش</button>";
                                    echo " ";
                                    echo "<button class='btn btn-outline-danger btn-sm' onclick=window.location.href='http://localhost/todo-php/todo/delete.php?id={$task['todoId']}'>حذف</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<div class='alert alert-danger' role='alert'><h4>داده ای برای نمایش وجود ندارد ، ابتدا تسک را ایجاد کنید</h4></div>";
                            }
                        } catch (PDOException $e) {
                            echo "dataBase Error : " . $e->getMessage();
                        }
                    }
                    ?>

                    </tbody>
                </table>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

            </body>
            </html>


        </h2>
    </main>
    </body>
    </html>

<?php include("Layout/footer.html.php"); ?>