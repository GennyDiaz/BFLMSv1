<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errmsg_arr = array();
    $errflag = false;

    include('database/db.php');
    $user = $_POST['username'];
    $pwd = md5($_POST['password']);

    $qry = "SELECT * FROM user WHERE username = '$user' AND password = '$pwd'";
    $result = mysqli_query($conn, $qry);
    if($result){
        if(mysqli_num_rows($result) > 0){

            session_regenerate_id();
            $use = mysqli_fetch_assoc($result);

            $_SESSION['user_id'] = $use['user_id'];

            if($use['user_type'] == 'Administrator'){
                header("location: authorize/index.php");
                exit();
            }else
            if($use['user_type'] == 'BRTO'){
                header("location: authorize/index.php");
                exit();
            }
        }else{
            echo "<div class='erlert'><center><h4>" . "Incorrect username or password." . "</h4></center></div>";
            exit();
        }
    }else{
        die("Query failed");
    }
}
?>