<div class="modal-body">
    <?php
    include '../database/db.php';

    $id = $_POST['id'];

    if($_POST['id']){
        $sqlresident =  mysqli_query($conn, "SELECT * FROM resident where resident_id = '$id'");
        while($row = mysqli_fetch_assoc($sqlresident)) {

            $count = mysqli_num_rows($sqlresident);
    ?>
                                <form method="POST" action="function_resident.php">
                                    <input type="hidden" name="id" value="<?=$row['resident_id']?>"/>
                                <div class="mb-3">
                                    <label for="first-name" class="col-form-label">First Name:</label>
                                    <input type="text" class="form-control" id="first-name" name="first_name" value="<?=$row['first_name']?>" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="middle-name" class="col-form-label">Middle Name:</label>
                                    <input type="text" class="form-control" id="middle-name" name="middle_name" value="<?=$row['middle_name']?>" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="last-name" class="col-form-label">Last Name:</label>
                                    <input type="text" class="form-control" id="last-name" name="last_name" value="<?=$row['last_name']?>" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="street_post" class="col-form-label">Street post:</label>
                                    <select class="form-select" aria-label="Default select example" id="street_post" name="street_post" required>
                                        <option selected hidden><?=$row['street_id']?></option>   
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
                                    <input type="tel" class="form-control" id="contact" name="contact" value="<?=$row['contact']?>" required/>
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