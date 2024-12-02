<?php
$host = "localhost";
$db_name = "traffic_management";
$user_name = "root";
$password = "";

try {
    $conn = new PDO("mysql:host={$host};dbname={$db_name};charset=UTF8", $user_name, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($conn) {
        /* echo "Connected successfully"; */
    } else {
        echo "Error while connecting to the database";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
