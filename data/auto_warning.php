<?php
require_once '../database/db.php';

$sql = mysqli_query($conn, "SELECT warning.sign_level, street.street_name, sensor.data, DATE_FORMAT(sensor.date_time, '%l:%i:%s %p') AS formatted_date_time, warning.surge_name, warning.info
FROM sensor
INNER JOIN warning ON sensor.sign_level = warning.sign_level
INNER JOIN street ON sensor.sensor_id = street.sensor_id
WHERE sensor.sensor_id = '1'
ORDER BY sensor.date_time DESC
LIMIT 1");

$data = array();
if($row = mysqli_fetch_assoc($sql)){
   $data[] = $row;
} else {
   echo 'No Available warning level';
}

echo json_encode($data);

?>