<?php

    require "config.php";

    function connect_to_db() {

        global $servername, $username, $password, $dbname, $port, $rows, $row;

        $connection = mysqli_connect($servername, $username, $password, "", $port);

        if (!$connection) {
            die("Connection failed: ".mysqli_connect_error());
        }

        if ($connection) {

            $connection = mysqli_connect($servername, $username, $password, $dbname, $port);

            $statement = "Select * from todo";
            $rows = $connection -> query($statement);
                
            if ($rows) {
                $row = mysqli_fetch_all($rows, MYSQLI_ASSOC);
            }
        }

    }

    function insertRecord($task, $date) {

        include "config.php";

        global $servername, $username, $password, $dbname, $port, $rows, $row;

        $connection = mysqli_connect($servername, $username, $password, $dbname, $port);

        if (!$connection) {
            die("Connection failed: ".mysqli_connect_error());
        }

        $sql = mysqli_query($connection, $getContents);
        $result = null;
        

        if ($task != null) {
            $sql ="INSERT INTO todo (task, due_date) VALUES ('$task', '$date')";
        }
        
        if ($sql != null) {
            $result = mysqli_query($connection, $sql);
        }

        if ($result == false) {
            printf("Error: %s\n", mysqli_error($connection));
        } else {
            echo "Record created.";
        }

    }

    function deleteRecord($id) {

        global $servername, $username, $password, $dbname, $port;

        $connection = mysqli_connect($servername, $username, $password, $dbname, $port);

        if (!$connection) {
            die("Connection failed: ".mysqli_connect_error());
        }

        $deleteQuery = null;

        $deleteQuery = "delete from todo where id = $id";
        mysqli_query($connection, $deleteQuery);

    }

    function editRecord($id, $updateTask, $updateDueDate = "") {

        global $servername, $username, $password, $dbname, $port;

        $connection = mysqli_connect($servername, $username, $password, $dbname, $port);

        if (!$connection) {
            die("Connection failed: ".mysqli_connect_error());
        }

        $editQuery = null;

        $editQuery = "update todo set task = '$updateTask', due_date = '$updateDueDate' where id = $id";

        mysqli_query($connection, $editQuery);

    }

    function getRecord($id) {

        global $servername, $username, $password, $dbname, $port;

        $connection = mysqli_connect($servername, $username, $password, $dbname, $port);

        if (!$connection) {
            die("Connection failed: ".mysqli_connect_error());
        }

        $getQuery = null;

        $getQuery = "Select task from todo where id = $id";

        $gotRecord = mysqli_query($connection, $getQuery);
        $singleRecord = $gotRecord -> fetch_assoc();

        foreach ($singleRecord as $key => $value) {
            echo $value;
        }

    }

?>