<?php 
    require_once "../config/Database.php";


    $database = new Database();
    $conn = $database->getConnection();

    $id = filter_input(INPUT_GET, 'id');
    

    if($id){
        $sql = $conn->prepare("DELETE FROM task WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        header('Location: ../index.php ');
        exit;
    }else {
        header('Location: ../index.php ');
        exit;
    }



?>