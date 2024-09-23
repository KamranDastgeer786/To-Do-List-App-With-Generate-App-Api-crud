<?php

if(isset($_POST['title']) && isset($_GET['id'])){
    require '../db_conn.php';

    $id = $_GET['id'];
    $title = $_POST['title'];

    if(empty($id) || empty($title)){
        echo json_encode(["status" => "error", "message" => "ID and title are required"], 400);
    } else {
        $stmt = $conn->prepare("UPDATE todos SET title=? WHERE id=?");
        $res = $stmt->execute([$title, $id]);

        if($res){
            echo json_encode(["status" => "success", "message" => "Todo updated successfully"], 200);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to update todo"], 500);
        }
        $conn = null;
        exit();
    }
    } else {
   echo json_encode(["status" => "error", "message" => "Invalid request"], 400);
}
?>
