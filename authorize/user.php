<script>
    $(document).ready(function(){

    $(document).on('click', '#getUser', function(e){
  
     e.preventDefault();
  
     var uid = $(this).data('id');      

     $.ajax({
          url: 'user_edit.php',
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
        <h4>User List</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card bg-custom text-white">
              <div class="card-header">
                <span><i class="bi bi-person-vcard me-2"></i></span> User List
              </div>
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-success me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><span><i class="bi bi-plus-circle me-2"></i></span>Add User</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog text-dark">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="function_user.php">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" id="recipient-name" name="name" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="user-name" class="col-form-label">Username:</label>
                                    <input type="text" class="form-control" id="user-name" name="username" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="col-form-label">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="user-type" class="col-form-label">User Type:</label>
                                    <select class="form-select" aria-label="Default select example" id="user-type" name="type" required>
                                        <option selected hidden></option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="BRTO">Rescue Team</option>
                                    </select>
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
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Type</th>
                                <th scope="col" style="width: 15%;text-align: center;">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../database/db.php';

                            $sqluser =  mysqli_query($conn, "SELECT * FROM user");
                            while($row = mysqli_fetch_assoc($sqluser)) {

                                $count = mysqli_num_rows($sqluser);
     
                            ?>
                            <tr>
                                <td><?=$row['name']?></td>
                                <td><?=$row['username']?></td>
                                <td><?=$row['user_type']?></td>
                                <td>
                                    <center>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                            <form action="function_user.php" method="post" id="deletefr">
                                            </form>
                                            <button type="submit" class="btn btn-danger" form="deletefr" name="delete" value="<?=$row['user_id']?>">Delete</button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="<?=$row['user_id']?>" id="getUser">Edit</button>
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