
<?php


include("database_connection.php");




if(isset($_POST["type"]))
{

  $query = "
  SELECT * FROM danger
  ORDER BY dangerType ASC
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $data = $statement->fetchAll();
  foreach($data as $row)
  {
   $output[] = array(
    'id'  => $row["id"],
    'name'  => $row["dangerType"]
   );
  }
  echo json_encode($output);
 }



?>