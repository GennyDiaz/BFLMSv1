<div class="modal-body">
<?php
    include '../database/db.php';

    $id = $_POST['id'];

    if($_POST['id']){
        $sqlnotif =  mysqli_query($conn, "SELECT * FROM warning where warning_id = '$id'");
        while($row = mysqli_fetch_assoc($sqlnotif)) {

            $count = mysqli_num_rows($sqlnotif);
    ?>
                                <form method="POST" action="function_warning.php">
                                    <input type="hidden" name="id" value="<?=$row['warning_id']?>"/> 
                                <div class="mb-3">
                                    <label for="sign" class="col-form-label">Sign Level:</label>
                                    <input type="text" class="form-control" id="sign" name="sign" value="<?=$row['sign_level']?>" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="surge" class="col-form-label">Storm Surge:</label>
                                    <input type="text" class="form-control" id="surge" name="surge"  value="<?=$row['surge_name']?>" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="info" class="col-form-label">Warning Info:</label>
                                    <textarea class="form-control" style="height: 100px" id="info" name="info" required><?=$row['info']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="meter" class="col-form-label">Meter Level:</label>
                                    <input type="text" class="form-control" id="meter" name="meter"  value="<?=$row['meter']?>" required/>
                                </div>
                                <label for="color" class="col-form-label">Color coding:</label>
                                    <select name="color" class="form-control" id="color">
                                        <option value="#adb5bd">Gray</option>
                                        <option value="#0d6efd">Blue</option>
                                        <option value="#ffc107">Yellow</option>
                                        <option value="#fd7e14">Orange</option>
                                        <option value="#dc3545">Red</option>
                                    </select>
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