<?php
$con=mysqli_connect("localhost","root","","bad_event");
//include("../db.php");

$pays=$_GET["id"];

if($pays!="")
{
$res=mysqli_query($con,"select * from ville where pays=$pays ORDER BY ville ASC");

var_dump($res);
echo "<select>";
while($row=mysqli_fetch_array($res))
{
    var_dump($row);
    echo '<option value="'.$row["id"].'">'.$row["ville"].'</option>';

}

echo "</select>";
}
?>