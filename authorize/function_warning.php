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
    
        $sql = "UPDATE warning set 
            sign_level = '$sign',
            surge_name = '$surge',
            info = '$info',
            meter = '$meter',
            color = '$color'
            where warning_id = '$id'";

    $query_run = mysqli_query($conn, $sql);
    if($query_run)
    {
        $_SESSION['message'] = "warning Update Successfully!','success";
    }else{
        $_SESSION['message'] = "warning Update Failed!','error";
    }
    header("Location: index.php?page=warning");
}else
if(isset($_POST['add'])){

    $sign = $_POST['sign'];
    $surge = $_POST['surge'];
    $info = $_POST['info'];
    $meter = $_POST['meter'];
    $color = $_POST['color'];

        $sql = "INSERT INTO warning (sign_level,surge_name,info,meter,color) Values
        ('$sign',
         '$surge',
         '$info',
         '$meter',
         '$color')";

    $query_run = mysqli_query($conn, $sql);
    if($query_run)
    {
        $_SESSION['message'] = "Add warning Successfully!','success";
    }else{
        $_SESSION['message'] = "Add warning Failed!','error";
    }
    header("Location: index.php?page=warning");
}else
if(isset($_POST['delete'])){
    $id = mysqli_real_escape_string($conn, $_POST['delete']);
    $sql =  mysqli_query($conn, "DELETE FROM warning WHERE warning_id = '$id' ");
    if($sql){
        $_SESSION['message'] = "Warning delete successfully!','success";
    }else{
        $_SESSION['message'] = "Warning delete failed!','error";
    }
    header("Location: index.php?page=warning");
}
?>