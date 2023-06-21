<script>
    $(document).ready(function(){

    $(document).on('click', '#getUser', function(e){
  
     e.preventDefault();
  
     var uid = $(this).data('id');      

     $.ajax({
          url: 'alert_edit.php',
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
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 pg-hd-color">
        <h4>Alert List</h4>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12 mb-3">
            <div class="card bg-custom text-white">
              <div class="card-header">
                <span><i class="bi bi-exclamation-triangle me-2"></i></span> Alert List
              </div>
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><span><i class="bi bi-plus-circle me-2"></i></span>Add Alert</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog text-dark">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Alert</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="function_alert.php">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="sign" class="col-form-label">Sign Level:</label>
                                    <input type="text" class="form-control" id="sign" name="sign" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="surge" class="col-form-label">Storm Surge:</label>
                                    <input type="text" class="form-control" id="surge" name="surge" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="info" class="col-form-label">Warning Info:</label>
                                    <textarea class="form-control" style="height: 100px" id="info" name="info" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="meter" class="col-form-label">Meter Level:</label>
                                    <input type="text" class="form-control" id="meter" name="meter" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="color" class="col-form-label">Color coding:</label>
                                    <input type="text" class="form-control" id="color" name="color" required/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="add" value="Add Alert"/>
                            </div>
                            </div>
                            </form>
                        </div>
                        </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="user" style="background: #212529;color: white;">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%;text-align: center;">Sign Level</th>
                                <th scope="col" style="width: 15%;">Storm Surge</th>
                                <th scope="col">Warning Info</th>
                                <th scope="col" style="width: 13%;">Meter Level</th>
                                <th scope="col" style="width: 15%;text-align: center;">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../database/db.php';

                            $sqlnotif =  mysqli_query($conn, "SELECT * FROM notification");
                            while($row = mysqli_fetch_assoc($sqlnotif)) {

                                $count = mysqli_num_rows($sqlnotif);
     
                            ?>
                            <tr style="background-color: <?=$row['color']?>;color: black;">
                                <td scope="row"><center><?=$row['sign_name']?></center></td>
                                <td><?=$row['surge']?></td>
                                <td><?=$row['info']?></td>
                                <td><?=$row['meter']?> Meter</td>
                                <td>
                                    <center>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="<?=$row['notification_id']?>" id="getUser">Edit</button>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                            <?php
                            }mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog text-dark">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="edit-modal">Edit User</h5>
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
    </div>
</div>
<script type="text/javascript">
        $(function() {
            $("#user").dataTable(
        { "aaSorting": [[ 2, "asc" ]] }
      );
        });
</script>