<?php
// Initialize the session
session_start();
 
// Vérifions si l'utilisateur est connecté, sinon redirigeons-le vers la page de connexion
if(!isset($_SESSION["connecter"]) || $_SESSION["connecter"] !== true){
    header("location: ../index.php");
    exit;
}

require_once "../../database/db.php";

?>
    <html lang="fr">

    <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ville - Opérateurs | Liste des informations</title>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
        <script src='../bootstrap/js/bootbox.min.js' type='text/javascript'></script>
        <script src='../bootstrap/js/delete-jq-ville.js' type='text/javascript'></script>
        <link rel="icon" type="image/png" href="../img/logo1.png" />
    </head>

    <body>
        <div id="wrapper">
            <!-- Sidebar -->
            <?php require'include/menu.php';?>
            <!-- / Sidebar -->

            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                <?php require'include/header.php';?>
                    <!-- / Topbar -->

                    <!-- Contenu de la page -->
                    <div class="container-fluid">
                        <!--     <?php if(@$errorMsg != ""): ?>
                      <div class="alert alert-success" role="alert">
                          <?php echo $errorMsg; ?>
                      </div>
                      <?php endif ?> -->
                        <div class="card mb-">
                            <div class="h4 card-header font-weight-normal" style="background: #a19e9e !important">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 class="mt-2 text-white">Les informations que vous avez ajouter</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="ajouter-ville.php">
                                            <button type="button" class="btn btn-ville m-1 float-right" style="background: #ff1300!important; color:#fff;">
                                                <i class="fa fa-plus-square fa-lg"></i>
                                                &nbsp;&nbsp; Ajouter
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                                <div class="row container-fluid mt-2">
                                    <section class="col-md-3"><p>Veuillez choisir un pays</p></section>
                                    <section class="col-md">
                                        <select name="pays" class="form-control" onchange="recupVilleTableau(this.value)">
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
                                <div id="listVille">

                                </div>
                                
                        </div>
                    </div>
                    <!-- ./Contenue de la page -->

                    <!-- Footer -->
                    <br>
                    <br>
                    <br>
                    <br>
                    <?php require'include/footer.php';?>
                    <!-- ./ Footer -->
                </div>
            </div>
            <!-- ./ Wrapper -->           

            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <script type="text/javascript">
                ! function(t) {
                    "use strict";
                    t("#sidebarToggle, #sidebarToggleTop").on("click", function(o) {
                            t("body").toggleClass("sidebar-toggled"),
                                t(".sidebar").toggleClass("toggled"),
                                t(".sidebar").hasClass("toggled") &&
                                t(".sidebar .collapse").collapse("hide")
                        }),
                        t(window).resize(function() {
                            t(window).width() < 768 &&
                                t(".sidebar .collapse").collapse("hide")
                        }),
                        t("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel", function(o) {
                            if (768 < t(window).width()) {
                                var e = o.originalEvent,
                                    l = e.wheelDelta || -e.detail;
                                this.scrollTop += 30 * (l < 0 ? 1 : -1), o.preventDefault()
                            }
                        }), t(document).on("scroll", function() {
                            100 < t(this).scrollTop() ? t(".scroll-to-top").fadeIn() :
                                t(".scroll-to-top").fadeOut()
                        }),
                        t(document).on("click", "a.scroll-to-top", function(o) {
                            var e = t(this);
                            t("html, body").stop().animate({
                                    scrollTop: t(e.attr("href")).offset().top
                                }, 1e3, "easeInOutExpo"),
                                o.preventDefault()
                        })
                }(jQuery);
                 
                function recupVilleTableau(str) {
                    var xhttp;  
                    if (str == "") {
                        document.getElementById("listVille").innerHTML = "";
                        return;
                    }
                    xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("listVille").innerHTML = this.responseText;
                        }
                    };
                    xhttp.open("GET", "traitement/ajax/list-ville.php?id="+str, true);
                    xhttp.send();
                    }
                    function recupVilleTableau(str) {
                    var xhttp;  
                    if (str == "") {
                        document.getElementById("listVille").innerHTML = "";
                        return;
                    }
                    xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("listVille").innerHTML = this.responseText;
                        }
                    };
                    xhttp.open("GET", "traitement/ajax/list-ville.php?id="+str, true);
                    xhttp.send();
                    }
            </script>
    </body>