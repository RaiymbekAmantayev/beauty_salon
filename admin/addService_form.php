<!DOCTYPE html>
<html>
<head>
    <title>Admin panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php require "../navbar/header.php" ?>
<div class="container">
    <h1>Add new information</h1>
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] === "admin"): ?>
        <p style="text-align: center">Good day, <?php echo $_SESSION['login']; ?></p>
    <a href="/" class="d-block text-center mb-4">Main Page</a>

    <form action="realise/addService.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter title" name="title" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Price" name="price" required>
        </div>
        <div class="form-group">
            <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
        </div>
        <div class="form-group">
            <textarea  class="form-control" placeholder="description" name="desc" required></textarea>
        </div>
        <button name="add" type="submit" class="btn btn-primary btn-block">Save</button>
    </form>
</div>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<style>
    body {
        background-image: url('/admin/realise/img/slide1.jpg');
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