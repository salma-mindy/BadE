<?php
require_once 'db.php';

//if(isset($_GET['submit'])){  
    
?>
 <table class="table table-bordered table-md">
  <thead class="thead-dark">
    <tr>
        <th>Dangertype</th>
        <th>Pays</th>
        <th>ville</th>
        <th>Responsable</th>
        <th>Victime</th>
        <th>Date</th>
        <th>source</th>
    </tr>
    </thead>
    <tbody>
<?php

$search=$_GET['search'];

$query=$db->prepare("SELECT * FROM danger WHERE idVille = '$search'");
@$recuptd= $db->query("SELECT id, intitule FROM dangertype")->fetchAll();
@$recuppays= $db->query("SELECT id , nom FROM pays")->fetchAll();
@$recupville= $db->query("SELECT id, ville FROM ville")->fetchAll();
@$recupacteur= $db->query("SELECT id, intitule FROM acteurs")->fetchAll();
$query->execute();
while($row=$query->fetch()){?>
 <tr>
    
    <td data-toggle="tooltip" data-placement="top" title="<?php echo $row['description'];?>">
        <?php
        foreach($recuptd  as $td)
        {
            if ($row['idDangerType'] == $td['id']) {
                echo $td['intitule'];
            }
        }
        ?>
    </td>
    <td>
        <?php 
            foreach($recuppays  as $pays)
            {
                if ($row["idPays"] == $pays['id']) {
                    echo $pays['nom'];
                }
            }
        ?>
    </td>
    <td>
        <?php 
            foreach($recupville  as $ville)
            {
                if ($row["idVille"] == $ville['id']) {
                    echo $ville['ville'];
                }
            }
        ?>
    </td>
    <td>
        <?php 
            foreach($recupacteur  as $acteur)
            {
                if ($row["sexeResponsable"] == $acteur['id']) {
                    echo $acteur['intitule'];
                }
            }
        ?>
    </td>
    <td>                                                                  
        <?php 
        foreach($recupacteur  as $acteur)
        {
            if ($row["sexeVictime"] == $acteur['id']) {
                echo $acteur['intitule'];
            }
        }
        ?>
    </td>
    <td><?php echo $row['date'];?></td>
    <td title="<?php echo $row['source'];?>"><a href="<?php echo $row['source'];?>" class="text-warning">Sources</a></td>
 </tr>
      
<?php
}

?>
</tbody>
 </table>
 
 <?php 
 
//    }

?>


