<?php
include '../database/db.php';

$sqldata = mysqli_query($conn, "SELECT s.sensor_id, s.street_name, se.data, w.color, w.surge_name
FROM street s
JOIN sensor se ON s.sensor_id = se.sensor_id
JOIN warning w ON se.sign_level = w.sign_level
WHERE se.tracking_id = (
  SELECT MAX(tracking_id)
  FROM sensor
  WHERE sensor_id = s.sensor_id
)");
$data = array();
while($row = mysqli_fetch_assoc($sqldata)){
    $data[] = $row;
}
echo json_encode($data);
?>