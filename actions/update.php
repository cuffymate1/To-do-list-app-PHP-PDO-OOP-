<?php
    require_once "../config/Database.php";


    $database = new Database();
    $conn = $database->getConnection();

    $description = filter_input(INPUT_POST, 'description');
    $id = filter_input(INPUT_POST, 'id');

    if($description && $id){
        $sql = $conn->prepare("UPDATE task SET description = :description WHERE id = :id");
        $sql->bindValue(':description', $description);
        $sql->bindValue(':id', $id);
        $sql->execute();

        header('Location: ../index.php ');
        exit;
    }else {
        header('Location: ../index.php ');
        exit;
    }
?>