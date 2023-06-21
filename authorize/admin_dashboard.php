<?php
include '../database/db.php';

$sqlsensor = mysqli_query($conn, "SELECT * FROM street");
$countsensor = mysqli_num_rows($sqlsensor);

$sqluser = mysqli_query($conn, "SELECT * FROM user");
$countuser = mysqli_num_rows($sqluser);

$sqlresident = mysqli_query($conn, "SELECT * FROM resident");
$countresident = mysqli_num_rows($sqlresident);

$sqlalert = mysqli_query($conn, "SELECT * FROM warning");
$countalert = mysqli_num_rows($sqlalert);

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 pg-hd-color">
        <h4>Admin Dashboard</h4>
        </div>
    </div>
    <div class="row">
          <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white h-100">
              <div class="card-body py-5">User Count <h1 style="float: right;"><?=$countuser?></h1></div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <a class="bi bi-chevron-right text-white" href="index.php?page=user"></a>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
              <div class="card-body py-5">Resident count <h1 style="float: right;"><?=$countresident?></h1></div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <a class="bi bi-chevron-right text-white" href="index.php?page=resident"></a>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
          <div class="card bg-warning text-dark h-100">
                <div class="card-body py-5">Sensor Count <h1 style="float: right;"><?=$countsensor?></h1></div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <a class="bi bi-chevron-right text-dark" href="index.php?page=street_map"></a>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white h-100">
              <div class="card-body py-5">Alert Level Count <h1 style="float: right;"><?=$countalert?></h1></div>
              <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                  <a class="bi bi-chevron-right text-white" href="index.php?page=warning"></a>
                </span>
              </div>
            </div>
          </div>
        </div>
    <div class="row">
        <div class="col-sm-3 mb-3">
            <div class="card bg-custom text-white">
                <div class="card-body">
                    <center>
                        <div class="card-header">
                            <span><i class="bi bi-water me-2"></i>Flood Rate</span> 
                        </div>
                    </center>
                </div>
                <div id="liquid_monitoring" class="rate"></div>
                <div class="card-footer d-flex">
                Main Sensor
                <span class="ms-auto">
                    <i class="bi bi-chevron-right" role="button"></i>
                </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3 w-custom">
          <div class="card bg-custom text-white">
            <div class="card-header">
              <span><i class="bi bi-graph-up me-2"></i>Line Chart</span> 
            </div>
            <div class="card-body">
              <canvas id="Mychart"></canvas>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card bg-custom text-white">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i>Sensor List</span> 
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>Sensor #</th>
                                <th>Street Name</th>
                                <th>Flood measure</th>
                                <th>Warning</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
  setInterval(function(){
    $.ajax({
        url: 'sensorlist_data.php',
        dataType: 'json',
        success: function(data) {

            var html = '';
            for (var i = 0; i < data.length; i++) {
                html += '<tr><td>' + data[i].sensor_id + '</td><td>' + data[i].street_name + '</td><td>' + data[i].data 
                + ' Meter</td><td style="color:'+ data[i].color +';">'+ data[i].surge_name +'</td></tr>';
            }
            $('#table tbody').html(html);
        }
      }, 100);
    });
  });
</script>