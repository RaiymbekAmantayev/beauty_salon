<?php
global $pdo;
require_once "C:\Users\User\Desktop\Райымбек\beauty-salon-bootstrap-html5-template\auth\db\connect.php";?>
<?php

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $service = $pdo->prepare("SELECT * FROM service WHERE id = :id");
    $service->bindParam(':id', $id);
    $service->execute();
    $res_serv = $service->fetch(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <?php require "../navbar/header.php" ?>
    <h1>Editing service information</h1>
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] === "admin"): ?>
        <p style="text-align: center">Good day, <?php echo $_SESSION['login']; ?></p>
    <?php endif; ?>
    <a href="/index.php" class="d-block text-center mb-4">Main Page</a>

    <form action="/admin/realise/addService.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $res_serv->id; ?>">
            <input type="text" class="form-control" placeholder="Enter title" name="title" value="<?php echo $res_serv->title; ?>" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Price" name="price" value="<?php echo $res_serv->price; ?>" required>
        </div>
        <div class="form-group">
            <input type="file" class="form-control" name="image" id="image" accept="image/*" value="<?php echo $res_serv->image; ?>" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Start date" name="desc" value="<?php echo $res_serv->description; ?>" required>
        </div>
        <button name="update" type="submit" class="btn btn-primary btn-block">Save</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<style>
    body {
        background-image: url('realise/img/slide2.jpg');
        background-size: cover;
        background-position: center;
        height: 100vh;
        display: flex;
        align-items: center;
    }

    .container {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
    }

    .form-control {
        border-radius: 5px;
    }

    h1 {
        text-align: center;
    }
</style>
