<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
    <link href="css/todoAppDatabase_style.css" rel="stylesheet">

    <title>Todo app with database</title>

</head>
<body>

    <?php
        
        require "config.php";
        require "functions.php";
        
    ?>

    <?php 

        global $updatedRecord;
        global $row;

        connect_to_db();

        empty($_POST['task']) ? $task = null : $task = $_POST['task'];
        empty($_POST['due_date']) ? $date = null : $date = $_POST['due_date'];
    
        if (isset($_POST['add'])) {
            insertRecord($_POST['task'], $_POST['due_date']);
        }
    
        if (isset($_POST['done'])) {
            deleteRecord($_POST['done']);
        }

        if (isset($_POST['edit'])) {
            $_SESSION['edit-id'] = $_POST['edit'];
        }

        if (isset($_POST['update'])) {
            global $updatedTask, $updatedDueDate;
            $updatedTask = $_POST['task'];
            $updatedDueDate = $_POST['due_date'];
            editRecord($_SESSION['edit-id'], $updatedTask, $updatedDueDate);
        }

        $task = null;
        $date = null;

    ?>

    <div class="card">
        <div class="card-body">

            <h1 class="card-title text-center">Todo app</h1>

            <form action="" method="POST">

                <label for="task">Task</label>
                <input type="text" name="task" class="form-control"  value="<?php echo isset($_POST['edit']) ? getRecord($_POST['edit']) : '' ?>" placeholder="What is your plan?...">
                <label for="due_date">Due</label>
                <input type="date" name="due_date" class="control">

                <br>

                <button class="btn btn-primary" name=<?php echo isset($_POST['edit']) ? "update" : "add" ?> type="submit" value="submit" id="addNupdate-id"><?php echo isset($_POST['edit']) ? "Update" : "Add"; ?></button>

                <?php
                
                if ($row != null) :

                    foreach ($row as $key => $array) :

                ?>

                <ul>
                    <li>

                    <?php
                        echo "<br><br>Due date: ".$array['due_date']."<br><br>Task: ".$array['task']."<br><br><br>";
                    ?>

                    </li>
                    
                    <button class="btn btn-success float-right" name="done" type="submit" value=<?php echo $array['id']; ?>>Done</button>
                    <button type="submit" class="btn btn-danger float-left" name="edit" value=<?php echo $array['id']; ?>>Edit</button>

                </ul>

                <?php

                    endforeach;
                
                endif;
                
                ?>

            </form>
        </div>
    </div>

</body>
</html>