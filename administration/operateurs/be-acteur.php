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
        <title>acteurs View - Opérateurs</title>
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
                                        Ajouter un type d'acteur
                                    </h6>
                                    <div class="card-body">
                                        <p class="card-text">
                                            <!-- <i class="fa fa-times text-acteurs" aria-hidden="true"></i>&nbsp; -->
                                            <form action="<?php  
                                                    if (isset($_GET['operation']) && ($_GET['operation'] == 'modification') ) {
                                                        echo 'traitement/update-acteurs.php?id='.$_GET['id'] ;
                                                    } else {
                                                        echo 'traitement/add-acteurs.php';

                                                    }
                                                    
                                                ?>" method="POST" enctype="multipart/form-data" class="container-fluid">
                                            <div class="form-group row mt-2">
                                                <label for="acteurs" class="col-lg-3 col-md-2 ">Acteur de acteurs</label>
                                                <div class="col-lg col-md col-sm">
                                                    <input type="text" name="acteurs" id="" class="form-control <?php echo $_SESSION['echec']; $_SESSION['echec']="";  ?>" <?php  if (@$_GET['operation'] == 'modification') {
                                                        require_once "../../database/db.php";
                                                        $req = $db->prepare('SELECT * FROM acteurs WHERE id = ?');
                                                        $acteur = $req->execute([$_GET['id']]);
                                                        $acteurs = $req->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach($acteurs as $acteur){ echo 'value="'.$acteur['intitule'].'"';};
                                                        
                                                    }; ?> required>
                                                    <div class="invalid-feedback"> <?php echo @$_SESSION['infoechec']; ?></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group ml-auto"> 
                                                <input type="submit" class="btn btn-primary btn-user btn-block"  value="<?php  
                                                    if (isset($_GET['operation'])) {
                                                        echo 'Modifier';
                                                        
                                                    } else {
                                                        echo 'Ajouter';
                                                    }
                                                    
                                                ?>"style="background: #ff1300!important; color:#fff;">
                                                    
                                                </div> 
                                            </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="card mb-4 mt-5">
                                    <h6 class="h4 card-header font-weight-normal text-center" style="background: #a19e9e !important">
                                        List type d'acteur
                                    </h6>
                                    <div id="operat" class="mx-auto text-center align-item-center">
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
                                            $sql = "SELECT COUNT(*) AS nb_acteurs FROM acteurs";
                                            // On prépare la requête
                                            $query = $db->prepare($sql);
                                            // On exécute
                                            $query->execute();
                                            // On récupère le nombre d'informations
                                            $result = $query->fetch();
                                            $nbacteurs = (int) $result['nb_acteurs'];
                                             
                                            // On détermine le nombre d'informations par page
                                            $parPage = 5;
                                            // On calcule le nombre de pages total
                                            $pages = ceil($nbacteurs / $parPage);
                                            // Calcul de la première information de la page
                                            $premier = ($currentPage * $parPage) - $parPage;
                                            
                                            $sql = 'SELECT * FROM acteurs  ORDER BY intitule DESC LIMIT :premier, :parpage;';
                                            // On prépare la requête
                                            $query = $db->prepare($sql);

                                            $query->bindValue(':premier', $premier, PDO::PARAM_INT);
                                            $query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
                            

                                            // On exécute
                                            $query->execute();
                                            // On récupère les valeurs dans un tableau associatif
                                            $acteurs = $query->fetchAll(PDO::FETCH_ASSOC);
                                             
                                            $d_nb = count($acteurs);
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
                                                                    <th>Type de acteurs</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <tbody class="text-center text-secondary">
                                                                    <?php $i=1;  foreach($acteurs as $acteur) { ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php echo $i++ ?>
                                                                        </td>
                                                                         <td>
                                                                            <?php echo $acteur['intitule']?>
                                                                         </td>
                                                                        <td>
                                                                        <?php
                                                                            if ($idUser == $acteur['idUtilisateur']) {
                                                                               echo '<a href="be-acteur.php?id='.$acteur['id'].'&operation=modification" type="button" class="text-primary">
                                                                                <i class="fa fa-edit fa-lg"></i>
                                                                            </a>&nbsp;&nbsp;
                                                                            <a class="text-acteurs text-danger" type="button" data-toggle="modal" data-target="#exampleModalCenter'.$acteur["id"].'"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                                                            ';?>
                                                                            </td>
                                                                            <?php
                                                                            echo '<tr>
                                                                            <div class="modal fade" id="exampleModalCenter'.$acteur["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title text-dark" id="exampleModalLongTitle'.$acteur["id"].'">Suppression Acteurs</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body text-dark" >
                                                                                    Etes vous sur de vouloir supprimer  ?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Annuler</button>
                                                                                        <a href="traitement/delete-acteurs.php?id='.$acteur["id"].'" class="btn btn-danger">Supprimer</a> 
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

                                                            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "text-acteurs" ?>">
                                                                <a class="page-link" href="?page=<?= $currentPage - 1 ?>" aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                                <span class="sr-only">Previous</span>
                                                                </a>
                                                            </li>

                                                            <?php for($page = 1; $page <= $pages; $page++): ?>
                                                                <li class="page-item <?= ($currentPage == $page) ? "active text-acteurs" : "" ?>">
                                                                    <a class="page-link" href="?page=<?= $page ?>">
                                                                        <?= $page ?>
                                                                    </a>
                                                                </li>
                                                            <?php endfor; ?>

                                                            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "text-acteurs" ?>">
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
