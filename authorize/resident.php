<script>
    $(document).ready(function(){

    $(document).on('click', '#getUser', function(e){
  
     e.preventDefault();
  
     var uid = $(this).data('id');      

     $.ajax({
          url: 'resident_edit.php',
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
        <h4>Resident List</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card bg-custom text-white">
              <div class="card-header">
                <span><i class="bi bi-people me-2"></i></span> Resident Info List
              </div>
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><span><i class="bi bi-plus-circle me-2"></i></span>Add Resident</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog text-dark">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Resident Info</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="function_resident.php">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="first-name" class="col-form-label">First Name:</label>
                                    <input type="text" class="form-control" id="first-name" name="first-name" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="middle-name" class="col-form-label">Middle Name:</label>
                                    <input type="text" class="form-control" id="middle-name" name="middle-name" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="last-name" class="col-form-label">Last Name:</label>
                                    <input type="text" class="form-control" id="last-name" name="last-name" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="street_post" class="col-form-label">Street post:</label>
                                    <select class="form-select" aria-label="Default select example" id="street_post" name="street_post" required>
                                        <option selected hidden></option>   
                                        <?php
                                        include '../database/db.php';

                                        $sqlstreet =  mysqli_query($conn, "SELECT * FROM street");
                                        while($rowstreet = mysqli_fetch_assoc($sqlstreet)) {
                                        ?>
                                        <option value="<?=$rowstreet['street_id']?>"><?=$rowstreet['street_name']?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="contact" class="col-form-label">Contact no:</label>
                                    <input type="tel" class="form-control" id="contact" name="contact" required/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="add" value="Add Resident"/>
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
                                <th scope="col">Name</th>
                                <th scope="col" style="width: 10%;text-align: center;">Street post</th>
                                <th scope="col" style="width: 10%;">Contact</th>
                                <th scope="col" style="width: 15%;text-align: center;">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlresident =  mysqli_query($conn, "SELECT * FROM resident");
                            while($row = mysqli_fetch_assoc($sqlresident)) {

                                $count = mysqli_num_rows($sqlresident);
     
                            ?>
                            <tr>
                                <td><?=$row['last_name'].', '.$row['first_name'].' '.$row['middle_name']?></td>
                                <td><center><?=$row['street_id']?></center></td>
                                <td><?=$row['contact']?></td>
                                <td>
                                    <center>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                            <form action="function_resident.php" method="post" id="deletefr">
                                            </form>
                                            <button type="submit" form="deletefr" class="btn btn-danger" name="delete" value="<?=$row['resident_id']?>">Delete</button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="<?=$row['resident_id']?>" id="getUser">Edit</button>
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
                                <h5 class="modal-title" id="edit-modal">Edit Resident Info</h5>
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