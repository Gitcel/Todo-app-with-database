<?php

    $servername = "localhost";
    $port = "3306";
    $username = "root";
    $password = "";
    $dbname = "todo_database";
    $getContents = file_get_contents("../data/init.sql");
    $connection;
    $row;
    $rows;

?>