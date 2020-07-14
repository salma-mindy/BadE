<?php
$con=mysqli_connect("localhost","root","","bad_event");
include("db.php");

?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Bad-Event</title>
    <script>
  
        
    </script>
</head>
<body>
<div class="container-fluid pt-5">
    <div class="row">
<div class="col-sm-11"></div>
<div class="col-sm-1">
<a style="color: #ffc500" href="contact.php"><i class="fas fa-envelope"></i></a>
</div>
    </div>
    <div class="row mt-1">
        <div class="col-sm-0 col-md-2 col-lg-3"></div>
        <div class="col-sm-12 col-md-10 col-lg-6">
            <div class="text-center mb-3">
                <a href="index.php">
                    <img src="img/logo.png" alt="logo" style="width: 300px; heigth: auto ">
                </a>
            </div>


            <!-----------------------------------------barre de recherche   -------------------------------------->
                <div class="form-row">
                <div class=" col-sm-5 mt-5 mb-1">
               <!--- <section><p>Veuillez choisir un pays</p></section>--->
                
        <section>
            <select name="pays" class="custom-select"  onchange="recupVilleCombo(this.value)">
            <option value="">-- Pays --</option>
            <?php
                    @$recuppays = $db->query("SELECT * FROM pays ORDER BY nom ASC")->fetchAll();
                    foreach ($recuppays as $pays)
                    {
                    echo '<option value="'.$pays['id'] .'">'.$pays['nom'] .'</option>';
                    }      
            ?>
            </select>
        </section>
                 </div>
              
              <div  class=" col-sm-5 mb-1">
              <section><label  for="ville"></label></section>
              <section> <select name="ville" class="custom-select mt-4" required id="comboville" >
        </select></section>                       
              </div>


              <div class=" col-sm-2 mt-5 mb-2">
              <button class="btn btn-primary" onclick="recupdanger(document.getElementById('comboville').value)">Recherche</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
    
           </div>
          

                </div>
        
      
