<?php
require 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title> to-do List</title>
     <link rel="stylesheet" href="css/style.css">
</head>

<body>
     <div class="main-section">
          <div class="add-section">
               <form action="app/add.php" method="POST" autocomplete="off">
                    <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                         <input type="text" name="title" style="border-color: red" placeholder="This field is required" />
                         <button type="submit">ADD &nbsp; <span>&#43;</span> </button>

                    <?php } else { ?>
                         <input type="text" name="title" placeholder="what do you need to do?" />
                         <button type="submit">ADD &nbsp; <span>&#43;</span> </button>
                    <?php } ?>
               </form>
          </div>

          <?php
          $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
          ?>

          <div class="show-todo-section">
               <?php if ($todos->rowCount() <= 0) { ?>
                    <div class="todo-item">
                         <div class="empty">
                              <img src="img/f.png" width="100%" />
                              <img src="img/Ellipsis (1).gif" width="90px">
                         </div>
                    </div>
               <?php } ?>

               <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="todo-item">
                         <span id="<?php echo $todo['id']; ?>" class="remove-to-do">x</span>
                         <?php if ($todo['checked']) { ?>
                              <input type="checkbox" data-todo-id="<?php echo $todo['id']; ?>" class="check-box" checked />
                              <h2 class="checked"><?php echo $todo['title'] ?></h2>
                         <?php } else { ?>
                              <input type="checkbox" data-todo-id="<?php echo $todo['id']; ?>" class="check-box" />
                              <h2><?php echo $todo['title'] ?></h2>
                         <?php } ?>
                         <br>
                         <small>created:<?php echo $todo['data_time'] ?></small>
                    </div>
               <?php } ?>
          </div>
     </div>
     <div class="login-section" style="position: absolute; right: 10px;">
          <!-- Logout button -->
          <form action="index.php" method="post">
               <button type="submit" style="padding: 5px; background-color: red; box-shadow: none;">Logout</button>
          </form>
     </div>
     <!-- <script>
          src = "js/jquery-3.2.1.min.js"
     </script> -->

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


     <script>
          $(document).ready(function() {
               $('.remove-to-do').click(function() {
                    const id = $(this).attr('id');
                    $.post("app/remove.php", {
                              id: id
                         },
                         (data) => {
                              if (data) {

                                   $(this).parent().hide(600);
                              }
                         }
                    );
               });
          });


          $(".check-box").click(function(e) {
               const id = $(this).attr('data-todo-id');

               $_POST('app/check.php', {
                         id: id
                    },
                    (data) => {
                         if (data != 'error') {
                              const h2 = $(this).next();
                              if (data === '1') {
                                   h2.removeClass('checked');
                              } else {
                                   h2.addClass('checked');
                              }
                         }
                    }
               );
          });
     </script>
</body>

</html>