<html>
  <head>
    <meta charset="utf-8" />
    <title>Bad-Event</title>
    <meta
      name="viewport"
      content="initial-scale=1,maximum-scale=1,user-scalable=no"/>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Load Leaflet from CDN -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script
      src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
      integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""
    ></script>

    <!-- Load Esri Leaflet from CDN -->
    <script
      src="https://unpkg.com/esri-leaflet@2.3.3/dist/esri-leaflet.js"
      integrity="sha512-cMQ5e58BDuu1pr9BQ/eGRn6HaR6Olh0ofcHFWe5XesdCITVuSBiBZZbhCijBe5ya238f/zMMRYIMIIg1jxv4sQ==" crossorigin=""
    ></script>

    <!-- Load Esri Leaflet Geocoder from CDN -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/esri-leaflet-geocoder@2.3.2/dist/esri-leaflet-geocoder.css"
      integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g==" crossorigin=""
    />

    <!-- CSS style -->
    <link rel="stylesheet" href="style.css">
    <!-- CSS bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script
      src="https://unpkg.com/esri-leaflet-geocoder@2.3.2/dist/esri-leaflet-geocoder.js"
      integrity="sha512-8twnXcrOGP3WfMvjB0jS5pNigFuIWj4ALwWEgxhZ+mxvjF5/FBPVd5uAxqT8dd2kUmTVK9+yQJ4CmTmSg/sXAQ=="crossorigin=""></script>

    <style>
      body {
        margin: 0;
        padding: 0;
      }
      #map {
        width: 100%;
        height: 400px;
      }
    </style>
  </head>
  <body>
  	<div class="container-fluid">
  	<div class="row mt-1">
        <div class="col-sm-0 col-md-2 col-lg-3"></div>
        <div class="col-sm-9 col-md-8 col-lg-6">
            <div class="text-center mb-5">
                <a href="../accueil.php">
                    <img src="img/logo.png" alt="logo" style="width: 200px; heigth: auto ">
                </a>
            </div>

            <!-- debut la barre de recherche -->
           <form action="" class="row mb-4">
                <input class="form-control" name="search" type="text" value="" id="search_user" placeholder="Rechercher un évènement" style="width: 92%;">
                <button class="btn p-0 rounded-0" name="submit" type="submit" value="" style="width: 8%; background: gray; color: #fff; font-size: 15px;">
                    <i class="fas fa-search"></i>
                </button>
           </form>
            <!-- fin la barre de recherche -->


           <!-- debut liens en bas de la barre -->
            <div class="col">
                <ul class="row list-inline justify-content-center" >
                    <li class="mx-3"><a href="../resultats_recherche.php"><i class="fas mr-1 fa-search"></i>Tous</a></li>
                    <li class="mx-3"><a href="../graph.php"><i class="fas mr-1 fa-chart-line"></i>Graph</a></li>
                    <li class="mx-3"><a href="../tableaux.php"><i class="fas mr-1 fa-table"></i>Tableaux</a></li>
                    <li class="mx-3"><a id="../active" href="maps.php"><i class="fas mr-1 fa-map-marked-alt"></i>Maps</a></li>
                </ul>
            </div>
            
            <!-- fin liens en bas de la barre -->
        </div>  
    </div>
    <hr>
    <div id="map"></div>
	    <script>
	      // https://esri.github.io/esri-leaflet/examples/geocoding-control.html

	      const coordAbidjan = { lat: 5.320357, lng: -4.016107 };
	      let coordsFromBrowser = { lat: coordAbidjan.lat, lng: coordAbidjan.lng };

	      navigator.geolocation.getCurrentPosition(function (position) {
	        console.log(
	          "position",
	          position.coords.latitude,
	          position.coords.longitude
	        );

	        coordsFromBrowser.lat = position.coords.latitude;
	        coordsFromBrowser.lng = position.coords.longitude;

	        map.setView([coordsFromBrowser.lat, coordsFromBrowser.lng], 15);
	      });

	      const map = L.map("map").setView([coordsFromBrowser.lat, coordsFromBrowser.lng], 12);



	      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);




	      // ajout des marqueurs depuis la base de donnée

        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = () => {
            // la transaction est terminée ?
            if (xmlhttp.readyState = 4) {
                // si la transaction est un succes
                if (xmlhttp.status = 200) {
                    // on traite les données
                    let donnees = JSON.parse(xmlhttp.responseText);
                    console.log(donnees)
                    // on boucle les données

                    Object.entries(donnees.produits).forEach(localisation => {
                        let marker = L.marker([localisation[1].lat, localisation[1].lng]).addTo(map)
                        marker.bindPopup(localisation[1].ville)
                        var circle = L.circle([localisation[1].lat, localisation[1].lng],{
                        	color : 'red',
                        	fillColor: '#f11',
                        	fillOpacity: 0.2,
                        	radius: 500
                        }).addTo(map)
                    })

                }else{
                    console.log(xmlhttp.statusTexte);
                }
            }
        }

        xmlhttp.open("GET", "produits/lire.php");

        xmlhttp.send(null);



	      const searchControl = L.esri.Geocoding.geosearch().addTo(map);

	      const results = L.layerGroup().addTo(map);

	      let markers = [];

	      searchControl.on("results", function (data) {
	        markers = [];
	        console.log("data", data);
	        results.clearLayers();
	        // several results as several towns with same name (like)
	        for (var i = data.results.length - 1; i >= 0; i--) {
	          const result = data.results[i];
	          const marker = L.marker(result.latlng);
	          marker.on("click", addRadius);
	        }
	      });

	      function addRadius(marker, radius = 1000) {
	        console.log("marker clicked", marker);
	        const circle = L.circle([marker.latlng.lat, marker.latlng.lng], {
	          radius,
	        });
	        console.log("circle", circle);
	        circle.addTo(map);
	        setTimeout(() => {
	          map.setZoom(15);
	        }, 1000);
	      }
	    </script>
    <div class="row mt-5 bg-dark">
    	<div class="col text-light">
        	<p class="text-center" >Copyright</p>
	    </div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>


	