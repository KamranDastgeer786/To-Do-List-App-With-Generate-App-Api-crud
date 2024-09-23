<?php

if(isset($_POST['id'])){
    require '../db_conn.php';

    $id = $_POST['id'];

    if(empty($id)){
        echo json_encode(["status" => "error", "message" => "Invalid ID"], 400);
    }else {
        $todos = $conn->prepare("SELECT id, checked FROM todos WHERE id=?");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $uId = $todo['id'];
        $checked = $todo['checked'];

        $uChecked = $checked ? 0 : 1;

        $res = $conn->query("UPDATE todos SET checked=$uChecked WHERE id=$uId");

        if($res){
            echo json_encode(["status" => "success", "message" => "Todo status updated", "checked" => $checked], 200);
        }else {
            echo json_encode(["status" => "error", "message" => "Failed to update todo status"], 500);
        }
        $conn = null;
        exit();
    }
   }else {
    echo json_encode(["status" => "error", "message" => "Invalid request"], 400);
}
?>