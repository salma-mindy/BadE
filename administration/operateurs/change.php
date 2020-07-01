<?php
    require_once "../../database/db.php";
    $pays = $_GET['paysId'];

    $stmt = $db->query("SELECT id,ville FROM ville WHERE pays ='$pays' ORDER BY ville");

    while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        echo "<option value='$row->id'>$row->ville</option>";
    }