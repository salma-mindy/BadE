<?php

//fetch.php

include('database_connection.php');

if(isset($_POST["dangerType"]))
{
 $query = "
 SELECT * FROM danger 
 WHERE dangerType = '".$_POST["dangerType"]."' 
 ORDER BY id ASC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'date'   => $row["date"],
   'nombrevictime'  => floatval($row["nombrevictime"])
  );
 }
 echo json_encode($output);
}

?>