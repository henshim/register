<?php
include 'main.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký người dùng</title>
</head>
<style>
    table{
        border-collapse:collapse ;
        border: 1px solid;
    }
    th,td{
        padding: 5px;
        font-size: 16px;
        color: blue;
        border: 1px solid;
    }
</style>
<body>
<form action="main.php" method="post">
    <fieldset>
        <legend>Đăng ký người dùng</legend>
        Tên <input type="text" name="name">
        <span style="color: red"><?php echo $nameErr; ?></span>
    </fieldset>
</form>
</body>
</html>
