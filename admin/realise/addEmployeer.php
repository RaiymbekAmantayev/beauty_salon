<?php
global $pdo;
require_once "C:\Users\User\Desktop\Райымбек\beauty-salon-bootstrap-html5-template\auth\db\connect.php";?>
<?php session_start(); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $name = isset($_POST["name"]) ? $_POST["name"] : "";
        $position = isset($_POST["pos"]) ? $_POST["pos"] : "";

        // Обработка загруженного файла
        $targetDir = "img/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Проверка, является ли файл изображением
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                echo "Файл является изображением - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "Файл не является изображением.";
                $uploadOk = 0;
            }
        }

        // Переместить файл в указанное место
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "Файл " . basename($_FILES["image"]["name"]) . " успешно загружен.";
        } else {
            echo "Ошибка загрузки файла.";
        }

        // Сохранить данные в базе данных
        $service = "INSERT INTO employeers (name, image, position) VALUES (:name, :image, :position)";
        $serv = $pdo->prepare($service);

        $params = [
            ":name" => $name,
            "image" => basename($_FILES["image"]["name"]),
            ":position" => $position,
        ];

        $serv->execute($params);

        header("Location: /admin/addEmployeer.php");
        exit();
    } else if (isset($_POST['delete'])) {
        // Получение ID записи, которую нужно удалить
        $id_to_delete = $_POST['id'];
        // SQL-запрос на удаление записи из таблицы
        $sql = "DELETE FROM employeers WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id_to_delete]);

        // После удаления перенаправьте пользователя или выполните другие действия
        header("Location: /index.php");
        exit();
    }else if (isset($_POST['add_to_service'])) {
        $id_services = $_POST['selected_services'];
        $id_employeer = $_POST['id_employeer'];

        $checkResponseQuery = "SELECT COUNT(*) AS count FROM service_employeers WHERE employee_id = :e_id AND service_id = :service_id";
        $checkResponseStmt = $pdo->prepare($checkResponseQuery);
        $stmtParams = [
            ':e_id' => $id_employeer
        ];

        $stmt = $pdo->prepare("INSERT INTO service_employeers (service_id, employee_id) VALUES (:service_id, :employee_id)");

        foreach ($id_services as $service_id) {
            $stmtParams[':service_id'] = $service_id;
            $checkResponseStmt->execute(array_merge($stmtParams, [':service_id' => $service_id]));
            $existingOrder = $checkResponseStmt->fetchColumn();

            if ($existingOrder == 0) {
                try {
                    $pdo->beginTransaction();
                    $stmt->execute([
                        ":service_id" => $service_id,
                        ":employee_id" => $id_employeer
                    ]);
                    $pdo->commit();
                } catch (PDOException $e) {
                    $pdo->rollBack();
                    // Обработка ошибки
                    echo "Ошибка: " . $e->getMessage();
                }
            }
        }
// После добавления перенаправляем пользователя на страницу просмотра сотрудников
        header("Location: /admin/employeers_view.php");
        exit();

    }
}

?>