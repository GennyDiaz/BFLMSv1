<?php
include '../database/db.php';
session_start();

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $sign = $_POST['sign'];
    $surge = $_POST['surge'];
    $info = $_POST['info'];
    $meter = $_POST['meter'];
    $color = $_POST['color'];
    
        $sql = "UPDATE notification set 
            sign_name = '$sign',
            surge = '$surge',
            info = '$info',
            meter = '$meter',
            color = '$color'
            where notification_id = '$id'";

    $query_run = mysqli_query($conn, $sql);
    if($query_run)
    {
        $_SESSION['message'] = "Alert Update Successfully!','success";
    }else{
        $_SESSION['message'] = "Alert Update Failed!','error";
    }
    header("Location: index.php?page=alert");
}else
if(isset($_POST['add'])){

    $sign = $_POST['sign'];
    $surge = $_POST['surge'];
    $info = $_POST['info'];
    $meter = $_POST['meter'];
    $color = $_POST['color'];

        $sql = "INSERT INTO notification (sign_name,surge,info,meter,color) Values
        ('$sign',
         '$surge',
         '$info',
         '$meter',
         '$color')";

    $query_run = mysqli_query($conn, $sql);
    if($query_run)
    {
        $_SESSION['message'] = "Add Alert Successfully!','success";
    }else{
        $_SESSION['message'] = "Add Alert Failed!','error";
    }
    header("Location: index.php?page=alert");
}
?>