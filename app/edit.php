<?php

if(isset($_POST['title']) && isset($_GET['id'])){
    require '../db_conn.php';

    $id = $_GET['id'];
    $title = $_POST['title'];

    if(empty($id) || empty($title)){
        header("Location: ../index.php?mess=error");
    } else {
        $stmt = $conn->prepare("UPDATE todos SET title=? WHERE id=?");
        $res = $stmt->execute([$title, $id]);

        if($res){
            header("Location: ../index.php?mess=success"); 
        } else {
            header("Location: ../index.php");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../index.php?mess=error");
}
?>
