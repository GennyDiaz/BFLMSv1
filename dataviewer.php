<?php
include 'database/db.php';
session_start();

$id = $_SESSION['viewer'];

$sqldata =  mysqli_query($conn, "SELECT s.street_name, w.surge_name, w.info, se.data 
FROM street s
JOIN sensor se ON se.sensor_id = s.sensor_id
JOIN warning w ON w.sign_level = se.sign_level
WHERE s.street_id = '$id'
ORDER BY se.tracking_id DESC 
LIMIT 1");

$data = array();
while($row = mysqli_fetch_assoc($sqldata)) {
    $data[] = $row;
}
echo json_encode($data);
?>