<?php
global $pdo;
require_once "C:\Users\User\Desktop\Райымбек\beauty-salon-bootstrap-html5-template\auth\db\connect.php";?>
<?php
session_start();
$user = $_SESSION["login"];
$service = $pdo->prepare("SELECT signup.*, service.title, service.image, service.price, users.id, users.login FROM signup INNER JOIN users ON signup.userID = users.id INNER JOIN service ON signup.serviceID = service.id WHERE users.login= :user_login order by signup.id desc;");

$service->bindParam(':user_login', $user, PDO::PARAM_STR);
$service->execute();
$res_serv = $service->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Orders</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">-->
</head>

<body>
<?php
require "navbar/header_user.php";
?>
<h1 style="text-align: center">Менің тіркелімдерім</h1>
<?php foreach($res_serv as $serv):?>
    <div class="request">
        <div class="card h-100">
            <div style="background-color: white" class="card-body">
                <a class="black-link" href="/detail.php?id=<?php echo $serv->serviceID; ?>" >
                    <img style=" height: auto; width: 25%; border-radius: 10%;" src="admin/realise/img/<?php echo $serv->image; ?>" alt="...">
                    <h5 class="card-title">title: <?php echo $serv->title?></h5>
                    <br>
                    <h5 class="card-title">price: <?php echo $serv->price?></h5>
                    <br>
                    <h5 class="card-title">time: <?php echo $serv->data_signup?></h5>
                    <br>
                    <h5 class="card-title">warning: <?php echo $serv->warning?></h5>
                    <br>
                </a>
                <form action="admin/realise/zapis.php" method="post" name="delete">
                    <input type="hidden" name="id" value="<?php echo $serv->id; ?>">
                    <button class="btn-danger-outline" type="submit" name="delete">Delete</button>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php require "navbar/footer.php" ?>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }
    .request {
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: white;
    }
    .request h5 {
        margin-top: 0;
        font-size: 18px;
        color: #333;
    }
    .request p {
        margin: 5px 0;
        font-size: 16px;
    }
    .black-link {
        color: black;
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

