<?php
include '../database/db.php';
session_start();

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $street = $_POST['street'];
    $sensor = $_POST['sensor'];
    $locationy = $_POST['locationy'];
    $locationx = $_POST['locationx'];
    
        $sql = "UPDATE street set 
            sensor_id = '$sensor',
            street_name = '$street',
            location_x = '$locationx',
            location_y = '$locationy'
            where street_id = '$id'";

    $query_run = mysqli_query($conn, $sql);
    if($query_run)
    {
        $_SESSION['message'] = "Street info Update Successfully!','success";
    }else{
        $_SESSION['message'] = "Street info Update Failed!','error";
    }
    header("Location: index.php?page=street");
}else
if(isset($_POST['add'])){

    $street = $_POST['street'];
    $sensor = $_POST['sensor'];
    $locationy = $_POST['locationy'];
    $locationx = $_POST['locationx'];

        $sql = "INSERT INTO street (sensor_id,street_name,location_x,location_y) Values
        ('$sensor',
         '$street'
         '$locationx',
         '$locationy')";

    $query_run = mysqli_query($conn, $sql);
    if($query_run)
    {
        $_SESSION['message'] = "Add Street info Successfully!','success";
    }else{
        $_SESSION['message'] = "Add Street info Failed!','error";
    }
    header("Location: index.php?page=street");
}else
if(isset($_POST['delete'])){
    $id = mysqli_real_escape_string($conn, $_POST['delete']);
    $sql =  mysqli_query($conn, "DELETE FROM street WHERE street_id = '$id' ");
    if($sql){
        $_SESSION['message'] = "Street delete successfully!','success";
    }else{
        $_SESSION['message'] = "Street delete failed!','error";
    }
    header("Location: index.php?page=street");
}
?>