<?php
require_once "../../database/db.php";

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $sql = "DELETE FROM danger WHERE id='$id' ";
    $query = $db->prepare($sql);
    $query -> execute();
    echo 1;
    header("location: delete-danger.php");
   exit;  
}
echo 0;
exit;
?>