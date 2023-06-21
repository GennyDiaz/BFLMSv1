<?php
include '../database/db.php';
session_start();

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $type = $_POST['type'];
    
    if(empty($_POST['password'])){
        $sql = "UPDATE user set 
            username = '$username',
            name = '$name',
            user_type = '$type'
            where user_id = '$id'";
    }else{
        $password = md5($_POST['password']);
        $sql = "UPDATE user set 
            username = '$username',
            password = '$password',
            name = '$name',
            user_type = '$type'
            where user_id = '$id'";
    }
    $query_run = mysqli_query($conn, $sql);
    if($query_run)
    {
        $_SESSION['message'] = "User Update Successfully!','success";
    }else{
        $_SESSION['message'] = "User Update Failed!','error";
    }
    header("Location: index.php?page=user");
}else
if(isset($_POST['add'])){

    $name = $_POST['name'];
    $username = $_POST['username'];
    $type = $_POST['type'];
    $password = md5($_POST['password']);

        $sql = "INSERT INTO user (username, password, name,user_type) Values
        ('$username',
         '$password',
         '$name',
         '$type')";

    $query_run = mysqli_query($conn, $sql);
    if($query_run)
    {
        $_SESSION['message'] = "Add User Successfully!','success";
    }else{
        $_SESSION['message'] = "Add User Failed!','error";
    }
    header("Location: index.php?page=user");
}else
if(isset($_POST['delete'])){
    $id = mysqli_real_escape_string($conn, $_POST['delete']);
    $sql =  mysqli_query($conn, "DELETE FROM user WHERE user_id = '$id' ");
    if($sql){
        $_SESSION['message'] = "User delete successfully!','success";
    }else{
        $_SESSION['message'] = "User delete failed!','error";
    }
    header("Location: index.php?page=user");
}
?>