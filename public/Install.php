<?php

    require "config.php";

    global $connection, $getContents;

    try {

        $connection = new PDO("mysql:host=$servername; port=$port", $username);
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Connected. ";
    
    }

    catch (PDOException $e) {

        echo "Failed to connnect. ".$e -> getMessage();

    }

    try {

        $connection = new PDO("mysql:dbname=$dbname;host=$servername; port=$port", $username);
        $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $createDatabase = $getContents;
        $connection -> exec($createDatabase);

    }

    catch (PDOException $e) {

        echo "Failed to create database. ".$e -> getMessage();

    }

    try {
        
        $connection -> exec($getContents);

    }

    catch (PDOException $e) {

        echo "Failed to create table. ".$e -> getMessage();

    }

    $connection = null;

?>