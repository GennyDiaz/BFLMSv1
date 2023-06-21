<script>
    $(document).ready(function(){

    $(document).on('click', '#getUser', function(e){
  
     e.preventDefault();
  
     var uid = $(this).data('id');      

     $.ajax({
          url: 'street_edit.php',
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
        <h4>Street List</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card bg-custom text-white">
              <div class="card-header">
                <span><i class="bi bi-signpost me-2"></i></span> Street List
              </div>
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><span><i class="bi bi-plus-circle me-2"></i></span>Add Street</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog text-dark">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Street</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="function_street.php">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="street-name" class="col-form-label">Street Name:</label>
                                    <input type="text" class="form-control" id="street-name" name="street" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="sensor" class="col-form-label">Sensor no:</label>
                                    <select class="form-select" aria-label="Default select example" id="sensor" name="sensor" required>
                                        <option selected hidden></option>
                                        <?php
                                        include '../database/db.php';

                                        $sqlstreet =  mysqli_query($conn, "SELECT DISTINCT sensor_id FROM sensor");
                                        while($row1 = mysqli_fetch_assoc($sqlstreet)) {
                                        ?>
                                        <option value="<?=$row1['sensor_id']?>"><?=$row1['sensor_id']?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="locationy" class="col-form-label">Location Y:</label>
                                    <input type="text" class="form-control" id="locationy" name="locationy" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="locationx" class="col-form-label">Location X:</label>
                                    <input type="text" class="form-control" id="locationx" name="locationx" required/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="add" value="Add User"/>
                            </div>
                            </div>
                            </form>
                        </div>
                        </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark table-hover" id="user">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 15%;">Sensor no.</th>
                                <th scope="col">Street Name</th>
                                <th scope="col" style="width: 15%;text-align: center;">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqluser =  mysqli_query($conn, "SELECT * FROM street");
                            while($row = mysqli_fetch_assoc($sqluser)) {

                                $count = mysqli_num_rows($sqluser);
     
                            ?>
                            <tr>
                                <td><?=$row['sensor_id']?></td>
                                <td><?=$row['street_name']?></td>
                                <td>
                                    <center>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                            <form action="function_street.php" method="post" id="deletefr">
                                            </form>
                                            <button type="submit" form="deletefr" class="btn btn-danger" name="delete" value="<?=$row['street_id']?>">Delete</button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="<?=$row['street_id']?>" id="getUser">Edit</button>
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