<?php

if(isset($_POST['id'])){
    require'../db_conn.php';

    $id =$_POST['title'];

    if(empty($id)){
       echo 'error';
    }else{
         $todo = $conn->prepare("SELECT id,checked FROM todos WHERE id=?");
         $todos->execute([$id]);

         $todo = $todos->fetch();
         $uId = $todo['id'];
         $checked = $todo['checked'];
         $uchecked = $checked ? 0 : 1;


         $res = $conn->query("UPDATE todos SET checked=$uchecked WHERE id=$uId");

         if($res){
            echo $checked;
         }else {
            echo "error";
         }
        $conn = null;
        exit();
    }
}else {
    header("location: ../index.php?mess=error");
}