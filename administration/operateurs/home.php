<?php
// Initialisation de la section
session_start();
 
// Vérifions si l'utilisateur est connecté, sinon redirigeons-le vers la page de connexion
if(!isset($_SESSION["connecter"]) || $_SESSION["connecter"] !== true){
    header("location: ../index.php");
    exit;
}
//var_dump($_SESSION);exit();
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <?php require'include/head.php';?>
        <title>Danger View - Opérateurs</title>
    </head>

    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
           <?php require'include/menu.php';?>
            <!-- / Sidebar -->

            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    
                    <?php require'include/header.php';?>
                    <!-- / Topbar -->

                    <!-- Contenue de la page -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card mb-5">
                                    <h6 class="h4 card-header font-weight-normal text-center" style="background: #a19e9e !important">
                                        Vos activités récentes
                                    </h6>
                                    <div class="card-body">
                                        <p class="card-text">
                                            <!-- <i class="fa fa-times text-danger" aria-hidden="true"></i>&nbsp; -->
                                            <i>Aucune activité</i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="card mb-4 mt-5">
                                    <div id="operat" class="mx-auto text-center align-item-center">
                                        <img class="img-responsive rounded-circle" src="https://cdn.pixabay.com/photo/2013/07/13/10/07/man-156584_960_720.png" alt="Card image cap">
                                        <div class="text-center mt-1">
                                            <b><?php echo htmlspecialchars($_SESSION["prenom"]); ?></b> <br>
                                            <span><?php echo htmlspecialchars($_SESSION["email"]); ?></span> <br>
                                            <span><a href="editer-profil-operateur.php" style="color: #ffc500; text-decoration: none;">Modifier vos informations</a></span>
                                        </div>
                                    </div>
                                    <div class="card-body mt-3 mb-4">
                                        <div class="row">
                                            <div class="col-md-4">

                                            </div>
                                            <div class="col-md-6">
                                                <h6>Vous Pouvez :</h6>
                                                <ul style="list-style-type: none;">
                                                    <li><i class="fa fa-hand-o-right" style="color: #ffc500 !important;"></i>&nbsp; Ajouter de nouvelles informations</li>
                                                    <li><i class="fa fa-hand-o-right" style="color: #ffc500 !important;"></i>&nbsp; Modifier une information enrégistrer</li>
                                                    <li><i class="fa fa-hand-o-right" style="color: #ffc500 !important;"></i>&nbsp; Supprimer une information enrégistrer</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Contenue de la page -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php require 'include/footer.php'; ?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- ./ Wrapper -->

        <!-- Navigation top-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fa fa-angle-up"></i>
        </a>

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
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
        </script>
    </body>

    </html>
