<?php

if(isset($_POST['title'])){
    require'../db_conn.php';

    $title =$_POST['title'];

    if(empty($title)){
        header("location: ../homePage.php?mess=error");
    }else{
        $stmt = $conn->prepare("INSERT INTO todos(title) VALUE(?)");
        $res =  $stmt->execute([$title]);

        if($res) {
            header("location: ../homePage.php?mess=success");
        }else {
            header("location: ../homePage.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("location: ../homePage.php?mess=error");
}
