<?php
include ('../database/db.php');
session_start();

if(isset($_SESSION['user_id'])){
  $sql = mysqli_query($conn,"SELECT * FROM user where user_id = '".$_SESSION['user_id']."'");
  $row = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$row['user_type'];?> || Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons-1.10.4/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="css/notify/jquery.jnotify.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/cdnjs/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <script src="css/bootstrap-icons-1.10.4/font/bootstrap-icons.json"></script>
    <script src="js/jqueryv3.6.3.js"></script>
    <!-- <script src="js/jquery.min.js"></script> -->
    <script src="js/cdnjs/jquery.jnotify.js"></script>

    <script src="js/chartscript.js"></script>
    <script src="js/D3js.js"></script>
    <script src="js/liquid.js"></script>

</head>

<body>
  <!-- navbar start-->
  <nav class="navbar navbar-expand-lg bg-custom fixed-top" data-bs-theme="dark">

  <div class="container-fluid">
    <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#sidebar"
        aria-controls="offcanvasExample"
      >
        <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
    </button>

    <a class="navbar-brand" href="#">BFLMS</a>

    <button class="navbar-toggler" 
      type="button" 
      data-bs-toggle="collapse" 
      data-bs-target="#topNavBar" 
      aria-controls="topNavBar" 
      aria-expanded="false" 
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?=$row['name'];?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
          </ul>
      </li>
      </ul>
    </div>
  </div>
</nav>
  <!-- navbar end-->
  <!-- offcanvas start-->
  <?php
  if($row['user_type'] == "Administrator"){
    include 'admin_sidebar.php';
  }else
  if($row['user_type'] == "BRTO"){
    include 'officer_sidebar.php';
  }
  ?>
    <!-- offcanvas end -->
    <main class="mt-5 pt-3">
    <?php
error_reporting(E_ALL ^ E_NOTICE);

if(isset($_GET['page'])){
  $page = $_GET['page'];
  $pages = array('dashboard','admin_dashboard','officer_sidebar','user','warning','resident','street','street_map','sensor_post');
  if (!empty($page)) {
      if(in_array($page,$pages)) {
          $page .= '.php';
          include($page);
      }
      else {
          echo 'Page not found. Return
          <a href="index.php?page=dashboard">dashboard</a>';
      }
  }
}
?>
    </main>
</body>
<script>
  function auto_warning(rawdata){

    var check = localStorage.getItem('datawarning');
    var text = 'WARNING! ' + 'Sign Level: ' + rawdata[0].sign_level + ' at ' + rawdata[0].street_name + ' Time: ' + rawdata[0].formatted_date_time +
    ' Flood Measure: ' + rawdata[0].data + 'cm' +'\n' + rawdata[0].surge_name + '\n' + rawdata[0].info;

    if(check == null){
      localStorage.setItem('datawarning', rawdata[0].sign_level);
      $.jnotify(text, 'warning', 15000);

    }else
    if(check != rawdata[0].sign_level){
      var remove = localStorage.removeItem('datawarning');
      if(remove){
        localStorage.setItem('datawarning', rawdata[0].sign_level);
        $.jnotify(text, 'warning', 15000);
      }
    }else{}

  }
  $(document).ready(function() {
  setInterval(function(){
    $.ajax({
        url: '../data/auto_warning.php',
        dataType: 'json',
        success: function(data) {

          auto_warning(data);
          
        }
    });
  }, 100);
  });

</script>
</html>
<?php
if(isset($_SESSION['message'])){
  echo "<script>

  $.jnotify('".$_SESSION['message']."',{
      autoHide: true,
      clickOverlay: false,
      minWidth: 250,
      timeShown: 3000
  });
  
  </script>";

unset($_SESSION['message']);
}
}else{
  $_SESSION['error_login'] = "Please! Login again...";
  header("location: ../login.php");
}
?>