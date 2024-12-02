<?php
// this is how to config the database connexion.
$host_name = "localhost";
$password = "";
$database_name = "traffic_management";
$user_name = "root";
$charset = "utf8";

try {
    $conn = new PDO("mysql:host={$host_name};dbname={$database_name};charset={$charset}", "{$user_name}", "{$password}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($conn) {
        $data = [
            'status' => 200,
            'message' => 'Connected sucessfully to the database'
        ];
        echo json_encode($data);
        header("HTTP/1.0 200 Connected sucessfully to the database");
    } else {
        $data = [
            'status' => 500,
            'message' => 'Failed to connect to the database, check your configuration file'
        ];
        echo json_encode($data);
        header("HTTP/1.0 500 Failed to connect to the database, check your configuration file");
    }
} catch (PDOException $e) {
    $data = [
        'status' => 404,
        'message' => $requestMethod . 'Unexpected Error!',
    ];
    header("HTTP/1.0  404  Unexpected Error!");
    return json_encode($data);
}
