<?php
include '../database/db.php';
session_start();
$getdata = $_SESSION['dpst'];

$sqldata = mysqli_query($conn, "SELECT s.*, se.*, w.*
FROM street s
JOIN sensor se ON s.sensor_id = se.sensor_id
JOIN warning w ON se.sign_level = w.sign_level
WHERE s.street_id = '".$getdata."'
ORDER BY se.tracking_id DESC");
$data = array();
while($row = mysqli_fetch_assoc($sqldata)){
    $data[] = $row;
}
echo json_encode($data);
?>