<?php
global $pdo;
require_once "C:\Users\User\Desktop\Райымбек\beauty-salon-bootstrap-html5-template\auth\db\connect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['send'])) {
        $login = $_SESSION['login'];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE login = :login");
        $stmt->execute([':login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $serviceID = isset($_POST["id"]) ? $_POST["id"] : "";
        $userID = $user['id'];
        $text = isset($_POST["text"]) ? $_POST["text"] : "";
        $archive = 0;

        // Проверяем, был ли загружен файл
        if (!empty($_FILES["image"]["name"])) {
            $targetDir = "images/";
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Проверяем, является ли файл изображением
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                echo "Файл является изображением - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "Файл не является изображением.";
                $uploadOk = 0;
            }

            // Перемещаем файл, если все условия выполнены
            if ($uploadOk && move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "Файл " . basename($_FILES["image"]["name"]) . " успешно загружен.";
            } else {
                echo "Ошибка загрузки файла.";
            }
        } else {
            echo "Файл не был загружен.";
        }

        if ($userID) {
            $query = "INSERT INTO comments (text, image, serviceID, userID, archive) VALUES (:text, :image, :serviceID, :userID, :archive)";
            $statement = $pdo->prepare($query);

            $params = [
                "text" => $text,
                "image" => (!empty($_FILES["image"]["name"])) ? basename($_FILES["image"]["name"]) : null, // Если файл был загружен, сохраняем его имя, иначе null
                "userID" => $userID,
                "serviceID" => $serviceID,
                "archive" => $archive
            ];
            $statement->execute($params);

            // Перенаправляем после вставки данных
            header("Location: /index.php");
            exit();
        } else {
            header("Location: /index.php");
            exit();
        }
    }else if (isset($_POST['delete'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM comments WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        header("Location: /index.php");
        exit();
    }
}
?>