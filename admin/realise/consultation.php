<?php
global $pdo;
require_once "C:\Users\User\Desktop\Райымбек\beauty-salon-bootstrap-html5-template\auth\db\connect.php";?>
<?php session_start(); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $name = isset($_POST["name"]) ? $_POST["name"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $question = isset($_POST["question"]) ? $_POST["question"] : "";
        // Сохранить данные в базе данных
        $service = "INSERT INTO consultation (name, email, question) VALUES (:name, :email, :question)";
        $serv = $pdo->prepare($service);

        $params = [
            ":name" => $name,
            ":email" => $email,
            ":question" => $question,
        ];

        $serv->execute($params);

        header("Location: /");
        exit();
    }else if(isset($_POST['delete'])){
        $id = $_POST['id'];
        // SQL-запрос на удаление записи из таблицы
        $sql = "DELETE FROM consultation WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        // После удаления перенаправьте пользователя или выполните другие действия
        header("Location: /");
        exit();
    }
}
?>