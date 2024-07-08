<?php 
require_once "../config/Database.php";

$database = new Database();
$conn = $database->getConnection();

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$completed = filter_input(INPUT_POST, 'completed', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);



if ($id !== null && $completed !== null) {
    try {
        $sql = $conn->prepare("UPDATE task SET completed = :completed WHERE id = :id");
        $sql->bindValue(':completed', $completed, PDO::PARAM_BOOL);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        echo json_encode(['success' => 1]);
    } catch (PDOException $e) {
        echo json_encode(['success' => 0, 'error' => $e->getMessage()]);
    }
    exit;
} else {
    echo json_encode(['success' => 0, 'error' => 'Invalid input']);
    exit;
}
?>
