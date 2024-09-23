<?php

if(isset($_POST['title'])){
    require '../db_conn.php';

    $title = $_POST['title'];

    if(empty($title)){
        echo json_encode(["status" => "error", "message" => "Title is required"], 400);
    }else {
        $stmt = $conn->prepare("INSERT INTO todos(title) VALUE(?)");
        $res = $stmt->execute([$title]);

        if($res){
            echo json_encode(["status" => "success", "message" => "Todo added successfully"], 200); 
        }else {
            echo json_encode(["status" => "error", "message" => "Failed to add todo"], 500);
        }
        $conn = null;
        exit();
    }
    }else {
    echo json_encode(["status" => "error", "message" => "Invalid request"], 400);
}
?>