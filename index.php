<?php
    require_once "./config/Database.php";

    $database = new Database();
    $conn = $database->getConnection();

    $tasks = [];
    $sql = $conn->query("SELECT * FROM task ORDER BY id ASC");

    if ($sql->rowCount() > 0) {
        $tasks = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .task {
            margin-bottom: 10px; 
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div id="to_do">
        <h1>Things To Do List</h1>

        <form action="actions/create.php" method="POST" class="to-do-form">
            <input type="text" name="description" placeholder="Write your task..." required>
            <button type="submit" class="form-button">
                <i class="bi bi-plus-lg"></i>
            </button>
        </form>

        <div id="tasks">
            <?php foreach ($tasks as $task): ?>
                <div class="task">
                    <input 
                        type="checkbox" 
                        name="progress" 
                        class="progress <?= $task['completed'] ? 'done' : '' ?>" 
                        data-task-id="<?= $task['id']?>"
                        <?= $task['completed'] ? 'checked' : '' ?>
                    >
                    <p class="task-description">
                        <?= ($task['description']) ?>
                    </p>
                    
                    <div class="task-action">
                        <a href="#" class="action-button edit-button">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="actions/delete.php?id=<?= $task['id']?>" class="action-button delete-button">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>

                    <form action="actions/update.php" method="POST" class="to-do-form edit-task hidden">
                        <input type="text" class="hidden" name="id" value="<?= $task['id'] ?>">
                        <input type="text" name="description" placeholder="Edit your task..." value="<?= ($task['description']) ?>">
                        <button type="submit" class="form-button comfirm-button">
                            <i class="bi bi-check-lg"></i>
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
