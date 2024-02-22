<?php
global $pdo;
require_once "C:\Users\User\Desktop\Райымбек\beauty-salon-bootstrap-html5-template\auth\db\connect.php";?>
<?php

$service = $pdo->prepare("SELECT * FROM consultation order by id desc");
$service->execute();
$res_serv = $service->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Заявки</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <link href="/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="/css/animate.css" rel="stylesheet" type="text/css">
</head>
<?php require "../NavBar/header.php" ?>
<body>
<h1 style="text-align: center">Консультацияға өтінімдер</h1>
<?php foreach($res_serv as $serv):?>
    <div class="request">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title"><?php echo $serv->name?></h5>
                <br>
                <h3 class="card-text"><?php echo $serv->email?></h3>
                <br>
                <p class="card-text"><?php echo $serv->question?></p>
            </div>
            <div class="buttons">
                <form action="/admin/realise/consultation.php" method="post" name="delClick">
                    <input type="hidden" name="form_id" value="del">
                    <input type="hidden" name="id" value="<?php echo $serv->id; ?>">
                    <button class="btn btn-primary" type="submit" name="delete">delete</button>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php require "../NavBar/footer.php" ?>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: white;
    }
    .requests {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .request {
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
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
</style>