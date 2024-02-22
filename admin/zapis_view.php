<?php
global $pdo;
require_once "C:\Users\User\Desktop\Райымбек\beauty-salon-bootstrap-html5-template\auth\db\connect.php";?>
<?php

$service = $pdo->prepare("SELECT signup.*, users.login AS userName, users.number as phone, service.title AS serviceName, service.price, employeers.name, employeers.id as e_id 
FROM signup 
INNER JOIN users ON signup.userID = users.id 
INNER JOIN employeers ON signup.employees_id = employeers.id 
INNER JOIN service ON signup.serviceID = service.id 
order by id desc;");
$service->execute();
$table = $service->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/style.css">
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
    <title>Client Db View</title>
</head>
<body>
<?php
require "../navbar/header.php";
?>
<h1>Client Db</h1>
<div class="orders-table">
    <table>
        <thead>
        <tr>
            <th>Login</th>
            <th>Phone</th>
            <th>Title</th>
            <th>Price</th>
            <th>Time</th>
            <th>Employeer</th>
            <th>Warning</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($table as $order) {

            echo "<tr>";
            echo "<td>" . $order['userName'] . "</td>";
            echo "<td>" . $order['phone'] . "</td>";
            echo "<td><a href='/detail.php?id=" . $order['serviceID'] . "'>" . $order['serviceName'] . "</a></td>";
            echo "<td>" . $order['price'] . "</td>";
            echo "<td>" . $order['data_signup'] . "</td>";
            echo "<td><a href='/admin/detailEmployeer.php?id=" . $order['e_id'] . "'>" . $order['name'] . "</a></td>";
            echo "<td>" . $order['warning'] . "</td>";
            ?>
            <td>
                <form action="realise/zapis.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                    <button type="submit" class="btn-danger-outline" name="delete">Delete</button>
                </form>
            </td>
            <?php
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>

<style>
    /* Стили для таблицы */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #f7f7f7;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #BC2A87;
        color: #f7f7f7;
    }

    /* Стили для заголовка */
    h1 {
        text-align: center;
    }

    /* Стили для контейнера таблицы */
    .orders-table {
        margin: auto;
        width: 90%;
    }
    .btn-danger-outline {
        background-color: transparent;
        border: 2px solid #dc3545;
        color: #dc3545;
        font-size: 14px;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-danger-outline:hover {
        background-color: #dc3545;
        color: white;
    }
</style>

</style>