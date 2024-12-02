<?php

include "../config/config.php";
include "../config/set-up.php";
// server method
$method = $_SERVER['REQUEST_METHOD'];

try {
    // test if the method is allowed
    if ($method === "GET") {
        // fetch data from the database
        $query = $conn->prepare("SELECT * FROM chauffeur ORDER BY id DESC");
        $query->execute();

        // fetch all the data form the table
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($res) > 0) {
            foreach ($res as $row) {
                $data = [
                    'status' => 200,
                    'message' => 'Data fetched successfully',
                    'data' => $row
                ];
                echo json_encode($data);
                header("HTTP/1.0 200 Data fetched successfully");
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'No data found'
            ];
            echo json_encode($data);
            header("HTTP/1.0 500 No data found");
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'this method is not allowed',
            'method' => $method
        ];
        echo json_encode($data);
        header("HTTP/1.0 500 this method is not correct");
    }
} catch (PDOException $e) {
    $data = [
        'status' => 404,
        'message' => 'Error while fetching data',
        'error' => $e->getMessage()
    ];
    echo json_encode($data);
    header("HTTP/1.0 404 Error while fetching data");
}
