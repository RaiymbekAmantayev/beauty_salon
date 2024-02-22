<?php global $pdo;
require_once "C:\Users\User\Desktop\Райымбек\beauty-salon-bootstrap-html5-template\auth\db\connect.php"  ?>
<?php
// Количество записей на одной странице
$limit = 8;

// Проверяем, существует ли параметр 'page' в URL
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Рассчитываем смещение
$offset = ($page - 1) * $limit;

// SQL-запрос с использованием LIMIT и OFFSET для пагинации
$service = $pdo->prepare("SELECT * FROM service ORDER BY id DESC LIMIT :limit OFFSET :offset");
$service->bindValue(':limit', $limit, PDO::PARAM_INT);
$service->bindValue(':offset', $offset, PDO::PARAM_INT);
$service->execute();
$res_serv = $array = $service->fetchAll(PDO::FETCH_OBJ);
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
    <?php
    require "navbar/header.php";
    ?>
<section  id="service">
    <div class="container">
        <h2>Біздің қызметтер</h2>
        <h6>Қызметтердің бағалары</h6>
        <a class="service_wrapper">
            <div class="row">
                <?php foreach($res_serv as $serv):?>
                    <div class="col-md-3">
                        <a href="detail.php?id=<?php echo $serv->id; ?>" class="black-link">
                        <img style=" width: 80%; height: 70%; border-radius: 5%" src="admin/realise/img/<?php echo $serv->image?>" class="card-img-top" alt="...">
                        <div class="service_block">
                            <h3 class="animated fadeInUp wow"><?php echo $serv->title?></h3>
                            <p class="animated fadeInDown wow">
                            </p>
                        </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
    </div>
    </div>
    <div class="pagination">
        <?php
        // Определяем общее количество записей
        $total_rows = $pdo->query('SELECT COUNT(*) FROM service')->fetchColumn();
        // Рассчитываем общее количество страниц
        $total_pages = ceil($total_rows / $limit);
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo '<a href="?page=' . $i . '" class="active">' . $i . '</a>';
            } else {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }
        }
        ?>
    </div>

</section>
    <?php
    require "navbar/footer.php";
    ?>

<style>
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .pagination a {
        display: inline-block;
        padding: 8px 16px;
        margin: 0 4px;
        border: 1px solid #ccc;
        border-radius: 4px;
        text-decoration: none;
        color: #333;
        transition: background-color 0.3s;
    }

    .pagination a:hover {
        background-color: #f0f0f0;
    }

    .pagination .active {
        background-color: #333;
        color: #fff;
    }
</style>
