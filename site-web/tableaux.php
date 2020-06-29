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
</head>
<body>


<div class="container-fluid pt-5">
    <div class="row">

    </div>
    <div class="row mt-1">
        <div class="col-sm-0 col-md-2 col-lg-3"></div>
        <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="text-center mb-5">
                <a href="accueil.php">
                    <img src="img/logo.png" alt="logo" style="width: 200px; heigth: auto ">
                </a>
            </div>

            <!-- debut la barre de recherche -->
           <form action="" class="row mb-4">
                <input class="form-control" name="search" type="text" value="" id="search_user" placeholder="Rechercher un évènement" style="width: 92%;">
                <button class="btn p-0 rounded-0" name="submit" type="submit" value="" style="width: 8%; background: gray; color: #fff; font-size: 23px;">
                    <i class="fas fa-search"></i>
                </button>
           </form>
            <!-- fin la barre de recherche -->


           <!-- debut liens en bas de la barre -->
            <div class="col">
                <ul class="row list-inline justify-content-center" >
                    <li class="mx-3"><a href="resultats_recherche.php"><i class="fas mr-1 fa-search"></i>Tous</a></li>
                    <li class="mx-3"><a href="graph.php"><i class="fas mr-1 fa-chart-line"></i>Graph</a></li>
                    <li class="mx-3"><a id="active" href="tableaux.php"><i class="fas mr-1 fa-table"></i>Tableaux</a></li>
                    <li class="mx-3"><a href="maps.php"><i class="fas mr-1 fa-map-marked-alt"></i>Maps</a></li>
                </ul>
            </div>
            
            <!-- fin liens en bas de la barre -->
        </div>  
    </div>
    <hr>


    <!-- debut section resultas de recherches //all -->

    <h1>Les Tableau ici</h1>

    <!-- fin section resultas de recherches -->

    
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>


