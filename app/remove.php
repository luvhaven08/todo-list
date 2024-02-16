<?php

if(isset($_POST['id'])){
    require'../db_conn.php';

    $id =$_POST['id'];

    if(empty($id)){
       echo 0;
    }else{
      echo "Remove function invoked";
         $stmt = $conn->prepare("DELETE FROM todos WHERE id=?");
         $res =  $stmt->execute([$id]);

        if($res) {
           echo 1;
        }else {
           echo 0;
        }
        $conn = null;
        exit();
    }
}else {
    header("location: ../index.php?mess=error");
}
