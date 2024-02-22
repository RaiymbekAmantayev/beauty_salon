<?php global $pdo;
require_once "C:\Users\User\Desktop\Райымбек\beauty-salon-bootstrap-html5-template\auth\db\connect.php";  ?>
<?php

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $service = $pdo->prepare("SELECT * FROM service WHERE id = :id");
    $service->bindParam(':id', $id);
    $service->execute();

    $res_serv = $service->fetch(PDO::FETCH_OBJ);
    $comments = $pdo->prepare("SELECT c.id, c.text, c.image, s.id as servId, s.title, s.price, u.login FROM comments c INNER JOIN service s ON c.serviceID = s.id INNER JOIN users u ON c.userID = u.id WHERE s.id = :id order by id desc");

    $comments->execute([
        ':id' => $id
    ]);
    $res_comments = $comments->fetchAll(PDO::FETCH_OBJ);

    $services = $pdo->prepare("SELECT se.*, s.title, s.id as s_id, e.id as e_id, e.name 
        FROM service_employeers se 
        INNER JOIN service s ON se.service_id = s.id 
        INNER JOIN employeers e ON se.employee_id = e.id
        WHERE s.id = :serviceId;
        ");
    $services->execute([
            ":serviceId"=>$id
    ]);
    $serv = $array = $services->fetchAll(PDO::FETCH_OBJ);
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1">
    <title>Beauty Salon Bootstrap HTML5 Template | Webthemez</title>
    <link rel="icon" href="favicon.png" type="image/png">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="css/animate.css" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
    <script src="js/respond-1.1.0.min.js"></script>
    <script src="js/html5shiv.js"></script>
    <script src="js/html5element.js"></script>
    <![endif]-->

</head>
<body>
<?php
require "navbar/header.php";
?>
<div style="background-color:white; text-align: center">
    <?php if(isset($res_serv)): ?>
        <h2 style="text-align: center; margin-top: 0%;"><?php echo $res_serv->title ?></h2>
        <img style="width: 25%; border-radius: 10%;" src="admin/realise/img/<?php echo $res_serv->image; ?>" alt="...">
        <p style="font-weight: bold">Цена: <?php echo $res_serv->price; ?></p>
        <p>Описание: <?php echo $res_serv->description; ?></p>
        <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] === "admin") {
            ?>
            <div class="buttons">
                <a href="admin/Update_serviceForm.php?id=<?php echo $res_serv->id; ?>" class="black-link">
                    <button  class="btn btn-primary ">edit</button>
                </a>
                <form style="text-align: center;" action="admin/realise/addService.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $res_serv->id; ?>">
                    <button type="submit" name="delete" class="btn btn-primary ">delete</button>
                </form>
            </div>
            <?php
        } else if (isset($_SESSION['login']) && $_SESSION['login'] != "admin") {
            ?>
            <div style="padding: 2%">
                <div class="mb-3">
                    <form action="/admin/realise/comment.php" method="post" enctype="multipart/form-data" name="comment">
                        <label for="exampleFormControlTextarea1" class="form-label">Напишите отзыв</label>
                        <input type="hidden" name="id" value="<?php echo $res_serv->id; ?>">
                        <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*" >
                        <button type="submit" name="send" class="btn btn-primary ">Отправить</button>
                    </form>
                </div>
            </div>
            <?php
        }
        ?>
    <?php else: ?>
        <p>Страница не найдена</p>
    <?php endif; ?>
</div>
</div>
<?php if (isset($res_comments) && count($res_comments)>0) : ?>

<h2 style="text-align: center;padding: 15px 0 0px;">Біздің клиенттеріміздің пікірлері:</h2>
<?php foreach($res_comments as $com):?>
<div class="request">
    <div class="card h-50">
        <div id="<?php echo $com->id?>" style="padding: 20px;font-size: 20px; text-align: center;" class="card-body">
            <img style=" height: auto; width: 10%; border-radius: 100%;" src="admin/realise/img/<?php echo $com->image; ?>" alt="...">
            <h5 class="card-title"><?php echo $com->login?></h5>
            <br>
            <h3 class="card-text"><?php echo $com->text?></h3>

        </div>
        <?php
        if ($_SESSION['login'] === "admin" || $_SESSION['login'] === $com->login) {
        ?>
        <div class="buttons">
            <form style="text-align: center;" action="admin/realise/comment.php" method="post" name="delCom">
                <input type="hidden" name="form_id" value="delete">
                <input type="hidden" name="id" value="<?php echo $com->id; ?>">
                <button class="btn btn-primary" type="submit" name="delete">delete</button>
            </form>
            <?php
            }
            ?>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php if(isset($res_serv) && (isset($_SESSION['login']) && $_SESSION['login'] != "admin")):
        ?>
        <div style="margin-top: 5%" class="container mt-4">
            <h2>Форма записи</h2>
            <form action="/admin/realise/zapis.php" method="POST">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="serviceID" name="serviceID" value="<?php echo $res_serv->id; ?>" required>
                </div>
                <div class="form-group">
                    <label for="data">Время записи:</label>
                    <input type="datetime-local" class="form-control" id="time" name="time" required>
                </div>
                <label class="form__label" for="selected_services">Выберите сотрудника:</label>
                <select id="selected_services" name="selected_services" multiple>
                    <?php foreach($serv as $service):?>
                        <option value="<?php echo $service->e_id ?>"><?php echo $service->name ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="form-group">
                    <label for="warning">Предупреждение:</label>
                    <textarea class="form-control" placeholder="здесь вы можете написать все примечании насчет записи" id="warning" name="warning" rows="3"></textarea>
                </div>
                <button name="add_sign" type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    <?php endif; ?>
    <?php require "navbar/footer.php" ?>
</body>
</html>
<style>
    .requests {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .request {
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: white;
    }
    .request h3 {
        margin-top: 0;
        font-size: 18px;
        color: #333;
    }
    .request p {
        margin: 5px 0;
        font-size: 16px;
    }
    .buttons {
        display: flex;
        justify-content: center;
    }
</style>