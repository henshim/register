<?php
function loadRegistration($filePath)
{
    $jsonData = file_get_contents($filePath);
    $arrData = json_decode($jsonData, true);
    return $arrData;
}

function saveDataJson($filePath, $name, $email, $phone)
{
    try {
        $contact = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        );
        $contact2 = array(
            'name' => $name
        );
        echo '<pre>';
        $arrData = loadRegistration($filePath);

        array_push($arrData, $contact);
        var_dump($arrData);
        $jsonData = json_encode($arrData, JSON_PRETTY_PRINT);

        var_dump($jsonData);
        var_dump($filePath);
        file_put_contents($filePath, $jsonData);
        echo '<span style="color: #ff0000"> lưu dữ liệu thành công!</span>';
    } catch (Exception $e) {
        echo 'error: ', $e->getMessage(), '<br>';
    }
}

$nameErr = null;
$emailErr = null;
$phoneErr = null;
$name = null;
$email = null;
$phone = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $has_error = false;
    if (empty($name)) {
        $nameErr = 'Nhập tên ';
        $has_error = true;
    }

    if (empty($email)) {
        $emailErr = 'Nhập email';
        $has_error = true;
    }
    if (empty($phone)) {
        $phoneErr = 'Nhập số điện thoại ';
        $has_error = true;
    }
    if ($has_error == false) {
        saveDataJson('user.json', $name, $email, $phone);
        $name = null;
        $email = null;
        $phone = null;
    }
}
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
    table {
        border-collapse: collapse;
        border: 1px solid;
    }

    th, td {
        padding: 5px;
        font-size: 16px;
        color: blue;
        border: 1px solid;
    }
</style>
<body>
<form method="post">
    <fieldset>
        <legend>Đăng ký người dùng</legend>
        Tên <input type="text" name="name"><br>
        <span style="color: red"><?php echo $nameErr; ?></span>
        Email: <input type="text" name="email"><br>
        <span style="color: yellow"><?php echo $emailErr; ?></span>
        Phone: <input type="text" name="phone"><br>
        <span style="color: green"><?php echo $phoneErr; ?></span>
        <button type="submit">Đăng ký</button>
    </fieldset>
</form>
<?php $loadData=loadRegistration('user.json'); ?>
<h2>danh sách đăng ký </h2>
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>
    <?php foreach ($loadData as $key): ?>
        <tr>
            <td><?php echo $key['name'] ?></td>
            <td><?php echo $key['email'] ?></td>
            <td><?php echo $key['phone'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>

