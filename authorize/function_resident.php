<?php
include '../database/db.php';
session_start();

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $first = $_POST['first_name'];
    $middle = $_POST['middle_name'];
    $last = $_POST['last_name'];
    $street = $_POST['street_post'];
    $contact = $_POST['contact'];
    
        $sql = "UPDATE resident set 
            first_name = '$first',
            last_name = '$last',
            middle_name	= '$middle',
            street_id = '$street',
            contact = '$contact'
            where resident_id = '$id'";

    $query_run = mysqli_query($conn, $sql);
    if($query_run)
    {
        $_SESSION['message'] = "Alert Resident Info Successfully!','success";
    }else{
        $_SESSION['message'] = "Alert Resident Info Failed!','error";
    }
    header("Location: index.php?page=resident");
}else
if(isset($_POST['add'])){

    $first = $_POST['first-name'];
    $middle = $_POST['middle-name'];
    $last = $_POST['last-name'];
    $street = $_POST['street_post'];
    $contact = $_POST['contact'];

        $sql = "INSERT INTO resident (first_name,last_name,middle_name,street_id,contact) Values
        ('$first',
         '$last',
         '$middle',
         '$street',
         '$contact')";

    $query_run = mysqli_query($conn, $sql);
    if($query_run)
    {
        $_SESSION['message'] = "Add Resident Info Successfully!','success";
    }else{
        $_SESSION['message'] = "Add Resident Info Failed!','error";
    }
    header("Location: index.php?page=resident");
}else
if(isset($_POST['delete'])){
    $id = mysqli_real_escape_string($conn, $_POST['delete']);
    $sql =  mysqli_query($conn, "DELETE FROM resident WHERE resident_id = '$id' ");
    if($sql){
        $_SESSION['message'] = "Resident delete successfully!','success";
    }else{
        $_SESSION['message'] = "Resident delete failed!','error";
    }
    header("Location: index.php?page=resident");
}
?>