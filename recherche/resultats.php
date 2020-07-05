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

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>


    <title>Bad-Event</title>
</head>
<body>


<div class="container-fluid pt-5">
    <div class="row">

    </div>
    <div class="row mt-5">
        <div class="col-sm-0 col-md-2 col-lg-3"></div>
        <div class="col-xs-8 col-md-8 col-lg-6">
            <div class="text-center mb-5">
                <a href="accueil.php">
                    <img src="img/logo.png" alt="logo" style="width: 400px; height: auto;">
                </a>
            </div>

            <!-- debut la barre de recherche -->
           <form action="" class="row mb-4" method="POST">
                <input class="form-control" name="search" type="text" value="" id="search_user" placeholder="Rechercher une ville" style="width: 92%;">
                <button class="btn p-0 rounded-0" name="submit" type="submit" value="submit" style="width: 8%; background: gray; color: #fff; font-size: 23px;">
                    <i class="fas fa-search"></i>
                </button>
           </form>
            <!-- fin la barre de recherche -->


           <!-- debut liens en bas de la barre -->
            <div class="col">
                <ul class="row list-inline justify-content-center" >
                    <li class="mx-3"><a href="resultats_recherche.php"><i class="fas mr-1 fa-search"></i>Tous</a></li>
                    <li class="mx-3"><a href="graph.php"><i class="fas mr-1 fa-chart-line"></i>Graph</a></li>
                    <li class="mx-3"><a href="tableaux.php"><i class="fas mr-1 fa-table"></i>Tableaux</a></li>
                    <li class="mx-3"><a href="maps.php"><i class="fas mr-1 fa-map-marked-alt"></i>Maps</a></li>
                </ul>
            </div>
            <!-- fin liens en bas de la barre -->
        </div>  
    </div>
    
<div class="row">
	<div class="col">
		<?php
		include("scripttab.php");
		?>
	</div>

	<div id="map" style="width: 100%; height: 400px;"></div>
	
	
</div>

    <div class="row">
        <div class="col pt-1" id="footer" style="margin-top:64vh;">
            <p class="text-center">Copyright 2020 - Bad-Event</p>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>