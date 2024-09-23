<?php 
require 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do List</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <script src="https://cdn-script.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body style="background-image: url(./img/body-image.jpg); background-repeat: no-repeat;  background-size:cover; text-align: center;">
    <div class="main-section">
        <div class="add-section" style="background: floralwhite";>
            <form action="app/add.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                <input type="text" name="title" style="border-color: #ff6666"placeholder="This field is required" />
                <button type="submit">Add &nbsp; <span>&#43;</span></button>
             <?php }else{ ?>
              <input type="text" name="title" placeholder="What do you need to do?" />
              <button type="submit" style="background-color: blue;">Add &nbsp; <span>&#43;</span></button>
             <?php } ?>
            </form>
        </div>
        <?php 
          $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
       ?>
       <div class="show-todo-section" style="background: floralwhite;">
            <?php if($todos->rowCount() <= 0){ ?>
                <div class="todo-item">
                    <div class="empty">
                        <img src="img/f.png" width="100%" />
                        <img src="img/Ellipsis.gif" width="80px">
                    </div>
                </div>
            <?php } ?>

            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <button type="button" class="edit-btn" edit-todo-id="<?php echo $todo['id']; ?>" style="float: right; padding: 10px 10px 10px 10px; background-color: green; color: white; font-size: 13px; text-decoration: none; border-radius: 8px; border-color: white; text-align: center;">
                    <i class="bi bi-pencil-square">  Edit </i>
                    </button>
                    <button type="button" id="<?php echo $todo['id']; ?>" style="float: right; padding: 10px 10px 10px 10px; background-color: blue; color: white; font-size: 13px; text-decoration: none; border-radius: 8px; border-color: white; text-align: center;">
                    <i class="bi bi-trash"> Delete </i>
                   </button>
                    <?php if($todo['checked']){ ?> 
                    <input type="checkbox" class="check-box" data-todo-id ="<?php echo $todo['id']; ?>"checked />
                    <h2 class="checked"><?php echo $todo['title'] ?></h2>
                    <?php }else { ?>
                    <input type="checkbox" data-todo-id ="<?php echo $todo['id']; ?>" class="check-box" />
                    <h2><?php echo $todo['title'] ?></h2>
                    <?php } ?>
                    <br>
                    <small>created: <?php echo $todo['date_time'] ?></small> 
                </div>
            <?php } ?>
       </div>
    </div>

    <!-- <script src="js/jquery-3.2.1.min.js"></script> -->

    <script src="js/Script.js"></script>
</body>
</html>