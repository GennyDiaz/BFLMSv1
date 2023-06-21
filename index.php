<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Flood Level v.1</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <header class="container-{breakpoint}">
        <div class="logo-wrapper d-flex align-item-center cover-image">
            <h1>
                <a href="index.php">
                    Barangay Flood Level
                </a>
            </h1>
        </div>

        <div class="container-fluid menu">
            <div class="container-{breakpoint}">
                <div class="d-flex menu-items">
                    <div class="active">
                        <a href="#">Home</a>
                    </div>
                    <div>
                        <a href="login.php">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section>
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
                <h5 class="card-header">Street post List</h5>
                <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-light table-hover" id="user">
                                <thead>
                                    <tr>
                                        <th scope="col">Street Name</th>
                                        <th scope="col" style="width: 15%;text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'database/db.php';
                                    $sqluser =  mysqli_query($conn, "SELECT * FROM street");
                                    while($row = mysqli_fetch_assoc($sqluser)) {

                                        $count = mysqli_num_rows($sqluser);
            
                                    ?>
                                    <tr>
                                        <td><?=$row['street_name']?></td>
                                        <td>
                                            <center>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="<?=$row['street_id']?>" id="getUser">View</button>
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <div class="modal-dialog text-dark">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="edit-modal">Street View Info</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div id="content">
                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <h5 class="card-header">Warning sign info</h5>
                <div class="card-body">
                    <?php
                        $sqlnotif =  mysqli_query($conn, "SELECT * FROM warning ORDER BY sign_level ASC");
                        while($row = mysqli_fetch_assoc($sqlnotif)) {
                    ?>
                    <div class="card mb-3" style="background: <?=$row['color']?>;">
                        <div class="card-header">
                            <?=$row['sign_level']."\n".$row['surge_name']?>
                        </div>
                        <div class="card-body">
                            <p class="card-text" style="float: left; width: 85%;"><?=$row['info']?></p>
                            <p style="float: right;"><?=$row['meter']?> Meter</p>
                        </div>
                    </div>
                    <?php
                        }mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
        </div>
    </div>
    </section>
    <footer>
    </footer>
</body>
</html>
<script>
    $(document).ready(function(){

    $(document).on('click', '#getUser', function(e){
  
     e.preventDefault();
  
     var uid = $(this).data('id');      

     $.ajax({
          url: 'viewer.php',
          type: 'POST',
          data: 'id='+uid,
          beforeSend:function()
{
 $("#content").html('Working on Please wait ..');
},
success:function(data)
{
   $("#content").html(data);
},
     })

    });
})
</script>