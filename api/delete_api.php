<?php

if(isset($_POST['id'])){
    require '../db_conn.php';

    $id = $_POST['id'];

    if(empty($id)){
        echo json_encode(["status" => "error", "message" => "Invalid ID"], 400), 0;
    }else {
        $stmt = $conn->prepare("DELETE FROM todos WHERE id=?");
        $res = $stmt->execute([$id]);

        if($res){
            echo json_encode(["status" => "success", "message" => "Todo deleted successfully"], 200), 1;
        }else {
            echo json_encode(["status" => "error", "message" => "Failed to delete todo"], 500), 0;
        }
        $conn = null;
        exit();
    }
}else {
    echo json_encode(["status" => "error", "message" => "Invalid request"], 400);
}
?>