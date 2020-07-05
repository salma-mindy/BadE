<?php
require_once 'db.php';
if(isset($_POST['submit'])){


$search=$_POST['search'];
$query=$db->prepare("SELECT * FROM ville WHERE nom_ville LIKE '$search' or lat LIKE '$search' or lng LIKE '$search' ");

$query->execute();
while($row=$query->fetch()){?>

<div class="container">
	
 <div class="col p-5" id="map" style="width: 100%; height: 700px;"></div>

    <script type="text/javascript">

        // Initialisation de la map

        var map = L.map('map').setView([<?php echo $row['lat'];?>, <?php echo $row['lng'];?>], 13);
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);

        // point marqueur en fonction de la recherche

        marker = L.marker([<?php echo $row['lat'];?>, <?php echo $row['lng'];?>]).addTo(map)
    </script>

</div>

   


      
<?php
}

?>

 <?php }
?>