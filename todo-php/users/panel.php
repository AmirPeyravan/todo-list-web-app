<?php include("../layout/header.html.php");




$id = $_GET['id'];
$sql = new PDO('mysql:dbname=if0_38474048_todo_db;host=sql108.infinityfree.com', 'if0_38474048', 'iK4oIFnxM3C8');
$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$data = $sql->prepare("SELECT * FROM userslist WHERE userId = :id");
$data->bindParam(':id', $id, PDO::PARAM_STR);
$data->execute();
$tasks = $data->fetch(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Layout/style.css">
</head>
<style>
    body {
        background-color: #12151c;
        color: #fff;
    }
    #main {
        max-width: 600px;
        margin-top: 50px;
        background: #1c1f26;
        padding: 20px;
        border-radius: 10px;
    }
    .avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        cursor: pointer;
        border: 3px solid #007bff;
    }
    .hidden-file-input {
        display: none;
    }
</style>
<style>
    body {
        background-color: #12151c;
        color: #fff;
    }
    #main {
        max-width: 600px;
        margin-top: 50px;
        background: #1c1f26;
        padding: 20px;
        border-radius: 10px;
    }
    .avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        cursor: pointer;
        border: 3px solid #007bff;
    }
    .hidden-file-input {
        display: none;
    }
    .form-label {
        text-align: right; /* این قسمت برای راست‌چین کردن عنوان‌ها */
        width: 100%;
        display: inline-block;
    }
    .form-control {
        text-align: right; /* این قسمت برای راست‌چین کردن ورودی‌ها */
    }
</style>
<body>
<main class="container my-5 content">
    <div id="main" class="container text-center">
        <h2>پنل کاربری</h2>
        <label for="avatarInput">
            <img src="../images/userAvatar/default1.png" alt="آواتار" class="avatar" id="avatarPreview">
        </label>
        <input type="file" id="avatarInput" class="hidden-file-input" accept="image/*">
        <div class="mt-3">
            <label class="form-label"> : نام کاربری</label>
            <input type="text" class="form-control" value="<?php echo $tasks['username'] ?>" disabled>
        </div>
        <div class="mt-3">
            <label class="form-label"> : رمز عبور</label>
            <input type="password" class="form-control" value="<?php echo $tasks['password'] ?>" disabled>
        </div>
    </div>
    <script>
        document.getElementById('avatarInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</main>
</body>


</html>

<?php include("../Layout/footer.html.php"); ?>
