<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 pg-hd-color">
        <h4>Barangay Dashboard</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 mb-3">
            <div class="card bg-custom text-white">
                <div class="card-body">
                    <center>
                        <div class="card-header">
                            <span><i class="bi bi-water me-2"></i></span> Flood Level
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
                    <span><i class="bi bi-graph-up me-2"></i></span> Line Chart
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
                <span><i class="bi bi-table me-2"></i></span> Sensor List
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>Sensor #</th>
                                <th>Sensor Name</th>
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