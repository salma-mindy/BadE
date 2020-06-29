<?php
require_once 'db.php';
if(isset($_POST['submit'])){
?>
 <table class="table table-hover">
  <thead>
    <tr>
        <th>numeroOrdre</th>
        <th>dangertype</th>
        <th>pays</th>
        <th>ville</th>
        <th>Responsable</th>
        <th>Victime</th>
        <th>description</th>
        <th>Date</th>
        <th>source</th>
    </tr>
    </thead>
    <tbody>
<?php

$search=$_POST['search'];
$query=$db->prepare("SELECT * FROM danger WHERE numeroOrdre LIKE '$search' or dangerType LIKE '$search' or pays LIKE '$search' or ville LIKE '$search'or sexeResponsable LIKE '$search'or sexeVictime LIKE '$search' or description LIKE '$search'or date LIKE '$search' or source LIKE '$search' ");

$query->execute();
while($row=$query->fetch()){?>
 <tr>
            <td><?php echo $row['numeroOrdre'];?></td>
            <td><?php echo $row['dangerType'];?></td>
            <td><?php echo $row['pays'];?></td>
            <td><?php echo $row['ville'];?></td>
            <td><?php echo $row['sexeResponsable'];?></td>
            <td><?php echo $row['sexeVictime'];?></td>
            <td><?php echo $row['description'];?>/td>
            <td><?php echo $row['date'];?></td>
            <td><?php echo $row['source'];?></td>
 </tr>
      
<?php
}

?>
</tbody>
 </table>
 <?php }
?>
