<div class="modal-body">
    <?php
    session_start();
    if($_POST['id']){
      $_SESSION['viewer'] = $_POST['id'];
    }
    ?>
    <div class="row" id="card">
      <center>
        <div class="card" style="width: 25rem;">
          <center><h1></h1></center>
          <div class="card-body">

            <h5 class="card-title"></h5>
            <h3></h3>
            <p class="card-text"></p>

          </div>
        </div>
      </center>
    </div>

</div>
<script>
$(document).ready(function() {
  setInterval(function(){
    $.ajax({
        url: 'dataviewer.php',
        dataType: 'json',
        success: function(data) {
            
            $('#card h1').html(data[0].data + ' Meter');
            $('#card h5').html(data[0].street_name);
            $('#card h3').html(data[0].surge_name);
            $('#card p').html(data[0].info);
        }
    });
  }, 100);
});
</script>