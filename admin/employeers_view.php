<?php
global $pdo;
require_once "C:\Users\User\Desktop\Райымбек\beauty-salon-bootstrap-html5-template\auth\db\connect.php";?>
<?php

$service = $pdo->prepare("SELECT * FROM employeers");
$service->execute();
$table = $service->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список сотрудников</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require "../navbar/header.php" ?>
<h1 style="text-align: center">Список сотрудников</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Должность</th>
        <th>Действие</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($table as $order) {

        echo "<tr>";
        echo "<td>". $order['id'] ."</td>";
        echo "<td><a href='/admin/detailEmployeer.php?id=" . $order['id'] . "'>" . $order['name'] . "</a></td>";
        echo "<td>" . $order['position'] . "</td>";
        ?>
        <td>
            <form action="realise/addEmployeer.php" method="post">
                <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                <button type="submit" class="delete-button" name="delete">Delete</button>
            </form>
        </td>
        <?php
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
<a href="addEmployeer.php"><button type="submit" class="add-button">add_employees</button></a>
</body>
</html>
<style>
    /* Стили для таблицы */
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Стили для кнопки */
    .delete-button {
        background-color: #ff0000;
        color: #fff;
        border: none;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
    }

    .add-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 1400px;
    }
</style>