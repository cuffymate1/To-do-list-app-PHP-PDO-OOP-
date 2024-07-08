<?php
    require_once "../config/Database.php";


    $database = new Database();
    $conn = $database->getConnection();

    $description = filter_input(INPUT_POST, 'description');
    

    if($description){
        $sql = $conn->prepare("INSERT INTO task (description) VALUES (:description)");
        $sql->bindValue(':description', $description);
        $sql->execute();

        header('Location: ../index.php ');
        exit;
    }else {
        header('Location: ../index.php ');
        exit;
    }
?>