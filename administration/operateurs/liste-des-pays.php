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
        <title>pays View - Opérateurs | Liste des informations</title>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
        <script src='../bootstrap/js/bootbox.min.js' type='text/javascript'></script>
        <script src='../bootstrap/js/delete-jq-pays.js' type='text/javascript'></script>
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

                    <!-- Contenue de la page -->
                    <div class="container-fluid">
                        <!--     <?php if($errorMsg != ""): ?>
                      <div class="alert alert-success" role="alert">
                          <?php echo $errorMsg; ?>
                      </div>
                      <?php endif ?> -->
                        <div class="card mb-4">
                            <div class="h4 card-header font-weight-normal" style="background: #a19e9e !important">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 class="mt-2 text-white">Les informations que vous avez ajouter</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="ajouter-pays.php">
                                            <button type="button" class="btn btn-pays m-1 float-right" style="background: #ff1300!important; color:#fff;">
                                                <i class="fa fa-plus-square fa-lg"></i>
                                                &nbsp;&nbsp; Ajouter
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <?php
                                // On détermine sur quelle page on se trouve
                                if(isset($_GET['page']) && !empty($_GET['page'])){
                                    $currentPage = (int) strip_tags($_GET['page']);
                                }else{
                                    $currentPage = 1;
                                }
                                // On se connecte à là base de données
                                require_once "../../database/db.php";
                                $idUser = $_SESSION["id"];

                                // On détermine le nombre total d'informations
                                $sql = "SELECT COUNT(*) AS nb_pays FROM pays WHERE idUtilisateur={$idUser}";
                                // On prépare la requête
                                $query = $db->prepare($sql);
                                // On exécute
                                $query->execute();
                                // On récupère le nombre d'informations
                                $result = $query->fetch();
                                $nbpays = (int) $result['nb_pays'];
                                // On détermine le nombre d'informations par page
                                $parPage = 5;
                                // On calcule le nombre de pages total
                                $pages = ceil($nbpays / $parPage);
                                // Calcul de la première information de la page
                                $premier = ($currentPage * $parPage) - $parPage;
                                
                                $sql = 'SELECT * FROM pays ORDER BY dateAjout DESC LIMIT :premier, :parpage;';
                                // On prépare la requête
                                $query = $db->prepare($sql);

                                $query->bindValue(':premier', $premier, PDO::PARAM_INT);
                                $query->bindValue(':parpage', $parPage, PDO::PARAM_INT);

                                // On exécute
                                $query->execute();
                                // On récupère les valeurs dans un tableau associatif
                                $pays = $query->fetchAll(PDO::FETCH_ASSOC);
                                $d_nb = count($pays);
                                //var_dump($d_nb);exit();
                            ?>
                                <div class="card-body">
                                    <?php if($d_nb === 0): ?>
                                    <center>
                                        <strong class="mt-4 mb-4">
                                            Pas d'informations disponible
                                        </strong>
                                    </center>
                                    <?php else: ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="p-1">
                                                <div class="table-responsive">
                                                    <table id="user_data" class="table table-striped table-sm table-bordered table-hover" style="color: #fff;">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>N</th>
                                                                <th>Nom</th>
                                                                <th>latitude</th>
                                                                <th>longitude</th>
                                                                <th>Nombre de ville</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tbody class="text-center text-secondary">
                                                                <?php $i=1;  foreach($pays as $pays) { ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo $i++ ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            echo $pays['nom'];
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            echo $pays['lat'];
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php 
                                                                            echo $pays['lng'];
                                                                         ?>
                                                                    </td>
                                                                    <td>
                                                                    <?php 
                                                                            $sql = 'SELECT COUNT(*) AS nb_pays FROM ville WHERE pays={echo '.$pays['id'].'}';
                                                                            $query = $db->prepare($sql);
                                                                            // On exécute
                                                                            $query->execute();
                                                                            // On récupère le nombre d'informations
                                                                            $result = $query->fetch();
                                                                            $nbpays = (int) $result['nb_pays'];
                                                                            echo  $nbpays;
                                                                         ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            if ($idUser == $pays['idUtilisateur']) {
                                                                               echo '<a href="ajouter-pays.php?id='.$pays['id'].'&operation=modification" type="button" class="text-primary">
                                                                                <i class="fa fa-edit fa-lg"></i>
                                                                            </a>&nbsp;&nbsp;
                                                                            <a class="text-danger" type="button" data-toggle="modal" data-target="#exampleModalCenter'.$pays["id"].'"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                                                            ';?>
                                                                            </td>
                                                                            <?php
                                                                            echo '<tr>
                                                                            <div class="modal fade" id="exampleModalCenter'.$pays["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title text-dark" id="exampleModalLongTitle'.$pays["id"].'">Suppression pays</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body text-dark" >
                                                                                    Etes vous sur de vouloir supprimer  ?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Annuler</button>
                                                                                        <a href="traitement/delete-pays.php?id='.$pays["id"].'" class="btn btn-danger">Supprimer</a> 
                                                                                </div>
                                                    
                                                                            </div>
                                                                            </div>';
                                                                        }
                                                                        ?>
                                                                </tr>
                                                                        <?php }; ?>
                                                            </tbody>
                                                    </table>
                                                    
                                                    <nav aria-label="pagination" >
                                                        
                                                        <ul class="pagination justify-content-center">

                                                            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "text-pays" ?>">
                                                                <a class="page-link" href="?page=<?= $currentPage - 1 ?>" aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                                <span class="sr-only">Previous</span>
                                                                </a>
                                                            </li>

                                                            <?php for($page = 1; $page <= $pages; $page++): ?>
                                                                <li class="page-item <?= ($currentPage == $page) ? "active text-pays" : "" ?>">
                                                                    <a class="page-link" href="?page=<?= $page ?>">
                                                                        <?= $page ?>
                                                                    </a>
                                                                </li>
                                                            <?php endfor; ?>

                                                            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "text-pays" ?>">
                                                                <a class="page-link" href="?page=<?= $currentPage + 1 ?>" aria-label="Next">
                                                                <span aria-hidden="true">&raquo;</span>
                                                                <span class="sr-only">Next</span>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif ?>
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
            </script>
    </body>
