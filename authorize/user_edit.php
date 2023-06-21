<div class="modal-body">
    <?php
    include '../database/db.php';

    $id = $_POST['id'];

    if($_POST['id']){
        $sqluser =  mysqli_query($conn, "SELECT * FROM user where user_id = '$id'");
        while($row = mysqli_fetch_assoc($sqluser)) {

            $count = mysqli_num_rows($sqluser);
    ?>
                                <form method="POST" action="function_user.php">
                                    <input type="hidden" name="id" value="<?=$row['user_id']?>"/>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" id="recipient-name" name="name" value="<?=$row['name']?>" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="user-name" class="col-form-label">Username:</label>
                                    <input type="text" class="form-control" id="user-name" name="username" value="<?=$row['username']?>" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="col-form-label">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password"/>
                                </div>
                                <div class="mb-3">
                                    <label for="user-type" class="col-form-label">User Type:</label>
                                    <select class="form-select" aria-label="Default select example" id="user-type" name="type">
                                        <option selected hidden><?=$row['user_type']?></option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="BRTO">Rescue Team</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" name="update" value="Update"/>
                                </div>
                                </form>
    <?php
      }
    }mysqli_close($conn);
    ?>
</div>