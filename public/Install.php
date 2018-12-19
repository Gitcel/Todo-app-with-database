<?php

    require "config.php";

    global $connection, $getContents;

    try {

        $connection = new PDO("mysql:host=$servername; port=$port", $username);
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Connected.<br>";
    
    }

    catch (PDOException $e) {

        echo "Failed to connnect. ".$e -> getMessage();

    }

    try {

        $connection = new PDO("mysql:dbname=$dbname;host=$servername; port=$port", $username);
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $connection -> exec($getContents);

        echo "Created database and/or tables.";

    }

    catch (PDOException $e) {

        echo "Failed to create database and/or tables. ".$e -> getMessage();

    }

    $connection = null;

?>