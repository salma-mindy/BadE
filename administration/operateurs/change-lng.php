<?php
    require_once "../php/db.php";

    $ville = $_GET['ville'];

    $stmt = $db->query("SELECT id,lng,lat FROM ville WHERE ville ='$ville' LIMIT 1");

    while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        echo "<div class='col-sm-6 mt-2'>
                <small><label class='my-1 mr-2' for='longitude' style='color: #ffc500'><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;longitude</i></label></small>
                <input type='text' class='form-control form-control-user disabled' id='longitude' name='longitude' value='$row->lng'>    
              </div>
              <div class='col-sm-6 mt-2'>
                <small><label class='my-1 mr-2' for='latitude' style='color: #ffc500'><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;latitude</i></label></small>
                <input type='text' class='form-control form-control-user  disabled' id='latitude' name='latitude' value='$row->lat'>
              </div>";
    }