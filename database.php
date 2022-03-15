<?php
    $dsn = 'mysql:host=localhost;dbname=D00237535';
    $username = 'D00237535';
    $password = 'MWKgSYa0';

    // $dsn = 'mysql:host=localhost;dbname=ssd_ca2_db';
    // $username = 'root';
    // $password = '';


    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>