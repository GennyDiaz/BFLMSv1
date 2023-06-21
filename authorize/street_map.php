<div class="container-fluid">
    <div class="row">
      <div class="col-md-12 pg-hd-color">
      <h4>Street Map</h4>
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card bg-custom text-white">
              <div class="card-header">
                <span><i class="bi bi-pin-map me-2"></i></span> Sensor Map
              </div>
              <div class="card-body">
                <div class="world-map">
                  <img src="css/image/map.png" alt="map"/>
                  <?php
                  include '../database/db.php';

                  $sqlsensor =  mysqli_query($conn, "SELECT * FROM street");
                  while($row = mysqli_fetch_assoc($sqlsensor)) {
                  ?>
                  <a href="index.php?data=<?=$row['street_id']?>&page=sensor_post">
                    <div class="pin" style="top: <?=$row['location_y']?>%;left: <?=$row['location_x']?>%;">
                      <span><?=$row['street_name']?></span>
                    </div>
                  </a>
                  <?php
                  }mysqli_close($conn);
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>