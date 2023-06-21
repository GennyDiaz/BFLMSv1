<?php
include '../database/db.php';

if(isset($_GET['data'])){
    $_SESSION['dpst'] = $_GET['data'];
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 pg-hd-color">
            <h4 id="street_name"></h4>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-5">
        <div class="card bg-custom text-white">
            <div class="card-header">Resident Contact no.</div>
            <div class="card-body" style="height: 36em;">
                <div class="table-responsive">
                    <table class="table table-dark table-hover" id="user">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" style="width: 9em;text-align: center;">Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = mysqli_query($conn, "SELECT * FROM resident WHERE street_id = '".$_GET['data']."'");
                            while($row = mysqli_fetch_assoc($sql)) {
                            ?>
                            <tr>
                                <td><?=$row['last_name'].', '.$row['first_name'].' '.$row['middle_name']?></td>
                                <td><?=$row['contact']?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
    <div class="col-sm-7">
        <div class="row" style="padding-bottom: 1.5em;">
            <div class="col-sm-6">
                <div class="card bg-custom text-white">
                    <div class="card-header">FLood Meter</div>
                    <div class="card-body">
                        <center>
                            <h1 id="meter_data"></h1>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card bg-custom text-white">
                    
                    <div class="card-header">Warning</div>
                    <div class="card-body">
                    <div class="card-title ">
                        <div class="row g-0">
                            <div class="col-sm-6 col-md-8" id="surge">
                                
                            </div>
                            <div id="level" class="col-6 col-md-4"><h3></h3></div>
                        </div>
                    </div>
                    <p id="info" class="card-text"></p>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                    <div class="card bg-custom text-white">
                    <div class="card-header">Message</div>
                        <div class="card-body">
                            <div class="form-floating text-dark">
                                <form method="POST" action="sms.php" id="sms">
                                    <textarea class="form-control text-fm" name="text" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">Compose Text Message:</label>
                                </form>
                                <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" form="sms" name="send" class="btn btn-success" value="<?=$_GET['data'];?>">send</button>
                                </div> 
                            </div>
                        </div>
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
        url: 'sensorpost_data.php',
        dataType: 'json',
        success: function(data) {
            
            $('#meter_data').html(data[0].data + ' Meter');
            $('#street_name').html('Sensor Post || ' + data[0].street_name);
            $('#surge').html(
                '<h2 style="color:' + data[0].color + ';float: left;">' + data[0].surge_name + '</h2>'
            );
            $('#level h3').html('Level ' + data[0].sign_level);
            $('#info').html(data[0].info);

        }
    });
  }, 100);
});
</script>