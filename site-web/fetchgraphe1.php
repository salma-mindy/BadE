<?php


include("db.php");

if(isset($_POST["year"]))
{
    /*$query  = "SELECT danger.idDangerType, dangertype.id, dangertype.intitule AS \'Type de Danger\', COUNT(*) AS \'Nombre de danger\' FROM danger, dangertype WHERE danger.idDangerType=dangertype.id  GROUP BY  '".$_POST["year"]."'";*/
    $query = "
    SELECT danger.idDangerType, dangertype.id, dangertype.intitule AS 'Type de Danger', date, COUNT(*) AS 'Nombre de danger' FROM danger, dangertype WHERE danger.idDangerType=dangertype.id AND YEAR(date)='".$_POST["year"]."' GROUP BY danger.idDangerType
    ";
 $sql= "
 SELECT * FROM chart_data 
 WHERE year = '".$_POST["year"]."' 
 ORDER BY id ASC
 ";
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 if (count($result) !== 0) {
     foreach($result as $row)
     {
      $output[] = array(
       'month'   => $row["Type de Danger"],
       'profit'  => floatval($row["Nombre de danger"])
      );
     }
     echo json_encode($output);    
 } else {
    $output[] = array(
        'month'   => 'Aucune données',
        'profit'  => 0
       );
       echo json_encode($output);
 }
 
}

?>
