<?php
class bflms{
    public $link='';

    function __construct($sensor,$data,$level){
        $this->connect();
        $this->storeInDB($sensor,$data,$level);
    }
    function connect(){
        $this->link = mysqli_connect('localhost','root','') or die('Cannot connect to the database');
        mysqli_select_db($this->link,'bflms') or die('Cannot select the database');
    }
    function storeInDB($sensor,$data,$level){
        $query = "INSERT INTO sensor set sensor_id = '".$sensor."', data = '".$data."', sign_level = '".$level."'";
        $result = mysqli_query($this->link,$query) or die('Error query: '.$query);
    }
}
if($_GET['street_id'] != '' && $_GET['data'] != '' && $_GET['level'] != ''){
    $bflmsv1 = new bflms ($_GET['street_id'],$_GET['data'],$_GET['level']);
}
?>