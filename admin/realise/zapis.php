<?php
global $pdo;
require_once "C:\Users\User\Desktop\Райымбек\beauty-salon-bootstrap-html5-template\auth\db\connect.php";?>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_sign'])) {
        $login = $_SESSION['login'];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE login = :login");
        $stmt->execute([':login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $servId = isset($_POST["serviceID"]) ? $_POST["serviceID"] : 1;
        $time = isset($_POST["time"]) ? $_POST["time"] : date("Y-m-d H:i:s"); // установите здесь правильное время записи
        $e_id = $_POST['selected_services'];
        $warning = isset($_POST["warning"]) ? $_POST["warning"] : "";


        $userId = $user['id'];
        $checkResponseQuery = "SELECT * FROM signup WHERE userID = :userID AND serviceID = :serviceID";
        $checkResponseStmt = $pdo->prepare($checkResponseQuery);
        $checkResponseStmt->execute([':userID' => $userId, ':serviceID' => $servId]);
        $existingOrder = $checkResponseStmt->fetch(PDO::FETCH_ASSOC);


        if ($userId && !$existingOrder) {
            $query = "INSERT INTO signup (userID, serviceID,data_signup, warning, employees_id) VALUES (:userID, :serviceID, :data_signup, :warning, :employees_id)";

            $statement = $pdo->prepare($query);

            $params = [
                "userID" => $userId,
                "serviceID" => $servId,
                "data_signup"=>$time,
                "warning"=>$warning,
                "employees_id"=>$e_id
            ];
            $statement->execute($params);

            header("Location: /");
            exit();
        } else {
            header("Location: /");
            exit();;
        }
    }
    else if (isset($_POST['delete'])) {
        // Retrieve the ID from the POST data
        $id = $_POST['id'];

        // Prepare the SQL deletion query
        $sql = "DELETE FROM signup WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        // Execute the deletion query
        $success = $stmt->execute([':id' => $id]);

        // Check for errors during the execution of the deletion query
        if ($success) {
            // If deletion was successful, redirect to a specific page
            header("Location: /");
            exit();
        } else {
            // If there was an error, display the error message
            $errorInfo = $stmt->errorInfo();
            echo "Error deleting record: " . $errorInfo[2];
        }
    }
}
?>