<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'data') or die ('ko kết nối đc')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Quản lý thông tin tên định danh</title>
</head>
<body>
    <div class="login-box">
        <img src="logo.jpg" style = "width:100%;" alt="">
        <h2>Đăng nhập</h2>
        <form action="index.php" method = "post">
            <div class="user-box">
            <input type="text" name="username" required="">
            <label>Username</label>
            </div>
            <div class="user-box">
            <input type="password" name="pass" required="">
            <label>Password</label>
            </div>
            <a href="">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <input type="submit" class="a" name="login" required="">
            </a>
        </form>
    </div>
    <?php
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $pass = $_POST['pass'];

    $select = mysqli_query($conn, "SELECT * FROM member WHERE username = '$username' AND pass = '$pass' ");
    $row = mysqli_fetch_array($select);

    if(is_array($row)){
        $_SESSION['username'] = $row ['username'];
        $_SESSION['pass'] = $row ['pass'];
    }    else
        echo '<script type = "text/javascript">';
        echo 'alert("sai thông tin đăng nhập");';
        echo 'window.location.href = "index.php "';
        echo '</script>';
    }
    
    if(isset($_SESSION['username'])){
        header("location:trangchu.php");
    }
    ?>
    
</body>
</html>