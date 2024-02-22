<?php global $pdo;
require_once "C:\Users\User\Desktop\Райымбек\beauty-salon-bootstrap-html5-template\auth\db\connect.php";  ?>
<?php

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $service = $pdo->prepare("SELECT * FROM employeers WHERE id = :id");
    $service->bindParam(':id', $id);
    $service->execute();
    $res_serv = $service->fetch(PDO::FETCH_OBJ);



    $services = $pdo->prepare("SELECT * FROM service");
    $services->execute();
    $serv = $array = $services->fetchAll(PDO::FETCH_OBJ);

    $service_view = $pdo->prepare("SELECT se.*, s.title, s.id as s_id, e.id, e.name FROM service_employeers se INNER JOIN service s ON se.service_id = s.id INNER JOIN employeers e ON se.employee_id = e.id WHERE e.id = :id");
    $service_view->bindParam(":id", $id);
    $service_view->execute();
    $views = $service_view->fetchAll(PDO::FETCH_OBJ);

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Детали сотрудника</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require "../navbar/header.php" ?>
<div class="container">
    <h1>Подробная информация сотрудника</h1>
    <div class="employee-details">
        <?php if(isset($res_serv)): ?>
        <img src="realise/img/<?php echo $res_serv->image; ?>" alt="...">
        <div style="color: black; font-size: 20px">
            <p><?php echo $res_serv->name ?>: <?php echo $res_serv->position ?></p>
        </div>
        <?php endif; ?>
        <div class="services-container">
            <p>Сервисы сотрудника:</p>
            <ul id="serviceList">
                <?php foreach($views as $view): ?>
                    <li><?php echo $view->title ?></li>
                <?php endforeach; ?>
            </ul>
        </div
    </div>
    <form action="realise/addEmployeer.php" method="post">
        <?php if(isset($res_serv)): ?>
            <input type="hidden" name="id_employeer" value="<?php echo $res_serv->id ?>"/>
        <?php endif; ?>

        <label class="form__label" for="selected_services">Выберите сервисы:</label>
        <select id="selected_services" name="selected_services[]" multiple>
            <?php foreach($serv as $service):?>
                <option value="<?php echo $service->id ?>"><?php echo $service->title ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="add_to_service" id="addServiceBtn">Добавить</button>
    </form>

</div>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .container>p{
        font-weight: bolder;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #000000;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #000000;
        font-weight: bold;
    }

    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    ul {
        list-style: none;
        padding: 0;
        margin: 10px 0;
    }

    li {
        margin-bottom: 5px;
    }
    .employee-details {
        height: 200px;
        /*width: 500px;*/
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .employee-details img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin-right: 20px;
    }
    .services-container {
        display: flex;
        margin-bottom: 10px;
        margin-left: 200px;
        margin-right: 80px;
        flex-direction: column;
        margin-top: 5%;
    }

    .services-container p {
        margin-right: 20px;
        font-weight: bold;
        color: #000000;
    }
</style>