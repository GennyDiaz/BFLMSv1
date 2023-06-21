<?php
include '../database/db.php';

$sql = mysqli_query($conn, "SELECT * FROM sensor where sensor_id = '1' ORDER BY date_time DESC limit 10");

$formattedData = array();

while($row = mysqli_fetch_assoc($sql)){
   $formattedData[] = array('x' => date('m/j g:i:s',strtotime($row['date_time'])), 'y' => $row['data']);
}

$formattedData = array_reverse($formattedData);
echo json_encode($formattedData);

?>