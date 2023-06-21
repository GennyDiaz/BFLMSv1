<div class="modal-body">
    <?php
    include '../database/db.php';

    $id = $_POST['id'];

    if($_POST['id']){
        $sqlstreet =  mysqli_query($conn, "SELECT * FROM street where street_id = '$id'");
        while($row = mysqli_fetch_assoc($sqlstreet)) {

    ?>
                                <form method="POST" action="function_street.php">
                                    <input type="hidden" name="id" value="<?=$row['street_id']?>">
                                <div class="mb-3">
                                    <label for="street-name" class="col-form-label">Street Name:</label>
                                    <input type="text" class="form-control" id="street-name" name="street" value="<?=$row['street_name']?>" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="sensor" class="col-form-label">Sensor no:</label>
                                    <select class="form-select" aria-label="Default select example" id="sensor" name="sensor" required>
                                        <option selected hidden><?=$row['sensor_id']?></option>
                                        <?php

                                        $sqlstreet1 =  mysqli_query($conn, "SELECT DISTINCT sensor_id FROM sensor");
                                        while($row1 = mysqli_fetch_assoc($sqlstreet1)) {
                                        ?>
                                        <!-- <option value="<?=$row1['sensor_id']?>"><?=$row1['sensor_id']?></option> -->
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="locationy" class="col-form-label">Location Y:</label>
                                    <input type="text" class="form-control" id="locationy" name="locationy" value="<?=$row['location_y']?>" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="locationx" class="col-form-label">Location X:</label>
                                    <input type="text" class="form-control" id="locationx" name="locationx" value="<?=$row['location_x']?>" required/>
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