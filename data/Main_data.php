<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bflms";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM sensor where sensor_id = '1' ORDER BY tracking_id DESC limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    $data = ($row['data'] / 20)*100;
  }
} else {
  $data = 0;
}
echo $data;

$conn->close();
?>