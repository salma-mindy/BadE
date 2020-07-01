<?php
// Initialize the session
session_start();
 
// Vérifions si l'utilisateur est connecté, sinon redirigeons-le vers la page de connexion
if(!isset($_SESSION["connecter"]) || $_SESSION["connecter"] !== true){
    header("location: ../index.php");
    exit;
}

require_once "../../database/db.php";

$description = $date = $source = $dangerType = $pays = "";
$ville = $sexeVictime = $sexeResponsable = "";
$ville_err = $sexeVictime_err = $sexeResponsable_err = "";
$description_err = $date_err = $source_err_err = $dangerType_err = $pays_err = "";
$errorMsg = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $idUser = $_SESSION["id"];
    //var_dump($_POST);
    //var_dump($idUser);exit();
      if (empty($_POST["description"])) {
        $description_err = "La description du danger est obligatoire";
      } else {
        $description = trim($_POST["description"]);
      }
    // validation date
      if (empty($_POST["date"])) {
        $date_err = "Le date est obligatoire";
      } else {
        $date = trim($_POST["date"]);
        $test_arr  = explode('/', $date);
        if (count($test_arr) == 3) {
            if (checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
                $date = trim($_POST["date"]);
            } else {
                $date_err = "Le format de la date est incorrecte";
            }
        }
      }
    
      if (empty($_POST["source"])) {
        $source_err = "La source est obligatoire";
      } else {
        $source = trim($_POST["source"]);
      }
    if(empty(trim($_POST["dangerType"]))){
        $dangerType_err = "Veuillez selectionner un type de danger.";
    } else{
        $dangerType = trim($_POST["dangerType"]);
    }
    if(empty(trim($_POST["paysId"]))){
        $pays_err = "Veuillez selectionner le pays.";     
    } else{
        $pays = trim($_POST["paysId"]);
    }

    if(empty(trim($_POST["ville"]))){
        $ville_err = "Veuillez selectionner la ville.";     
    } else{
        $ville = trim($_POST["ville"]);
    }
    if(empty(trim($_POST["sexeVictime"]))){
        $sexeVictime_err = "Veuillez selectionner le sexe victime.";     
    } else{
        $sexeVictime = trim($_POST["sexeVictime"]);
    }

    if(empty(trim($_POST["sexeResponsable"]))){
        $sexeResponsable_err = "Veuillez selectionner le sexe responsable.";     
    } else{
        $sexeResponsable = trim($_POST["sexeResponsable"]);
    }
    
    // Vérification des erreurs de saisie avant l'insertion dans la base de données
    if( empty($description_err) && 
       empty($date_err) && 
       empty($source_err) &&
       empty($dangerType_err) &&
       empty($pays_err) &&
       empty($ville_err) &&
       empty($sexeVictime_err) &&
       empty($sexeResponsable_err)){
        
        //stockage des données dans un tableau

        $newdanger =[
            'descriptionEvent'       => $description,
            'dateEvent'         => $date,
            'source'            => $source,
            'dangerType'        => $dangerType,
            'pays'              => $pays,
            'ville'             => $ville,
            'sexeVictime'       => $sexeVictime,
            'sexeResponsable'   => $sexeResponsable,
            'idUtilisateur'     => $idUser,
            'dateAjout'         => date("Y-m-d H:i:s"),
            'dateModification'  => date("Y-m-d H:i:s")
        ];
        
        // Préparons une instruction d'insertion
        $sql = "INSERT INTO danger (description,  date,   source, idDangerType, idPays, idVille, sexeVictime, sexeResponsable, idUtilisateur, dateAjout, dateModification) 
                VALUES             (:descriptionEvent, :dateEvent, :source, :dangerType, :pays, :ville, :sexeVictime, :sexeResponsable, :idUtilisateur, :dateAjout, :dateModification)";
         
        if($stmt = $db->prepare($sql)){
             
            if($stmt->execute($newdanger)){
               $errorMsg = "success";
            } else{
                $errorMsg = "error";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require'include/head.php';?>
     
    <title>Danger View - Admin | Ajouter</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <script>
        function comboInit(paysId){
            pays = document.getElementById(pays);  
            var idx = paysId.selectedIndex;
            var content = paysId.options[idx].innerHTML;
            if(pays.value == "")
                pays.value = content;	
        }

        function combo(paysId, pays){
            pays = document.getElementById(pays);  
            var idx = paysId.selectedIndex;
            var content = paysId.options[idx].innerHTML;
            pays.value = content;	
        }
        $(function() {
            $("#paysId").bind("change", function() {
                $.ajax({
                    type: "GET", 
                    url: "change.php",
                    data: "paysId="+$("#paysId").val(),
                    success: function(html) {
                        $("#ville").html(html);
                    }
                });
            });
            $("#ville").bind("change", function() {
                $.ajax({
                    type: "GET", 
                    url: "change-lng.php",
                    data: "ville="+$("#ville").val(),
                    success: function(html) {
                        $("#latLng").html(html);
                    }
                });
            });
        });
        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> -->
    <?php 
        if($errorMsg === "success"){
            echo '<script type="text/javascript">
                    $(document).ready(function(){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                              toast.addEventListener("mouseenter", Swal.stopTimer)
                              toast.addEventListener("mouseleave", Swal.resumeTimer)
                            }
                          })
                          
                          Toast.fire({
                            icon: "success",
                            title: "Danger ajouté avec succès!"
                          })
                    });
                </script>';
        }elseif($errorMsg === "error"){
            echo '<script type="text/javascript">
                    $(document).ready(function(){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                              toast.addEventListener("mouseenter", Swal.stopTimer)
                              toast.addEventListener("mouseleave", Swal.resumeTimer)
                            }
                          })
                          
                          Toast.fire({
                            icon: "error",
                            title: "Une erreur s\'est produite lors de l\'ajout, veillez réessayer svp!"
                          })
                    });
                </script>';
        }
    ?>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/logo1.png" />
    
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
                    
                    <div class="card mb-4">
                        <h5 class=" h4 card-header" style="background: #a19e9e !important">
                            <center><?php  
                                if (isset($_GET['operation']) && ($_GET['operation'] == 'modification') ) {
                                    echo 'Modification pays';
                                    if(!empty($_GET['id'])) 
                                    {
                                        $id = strip_tags($_GET['id']);
                                         
                                    }    
                                    $recupUnique = $db->query("SELECT * FROM pays WHERE id= $id");
                                    $pays = $recupUnique->fetch();
                                } else {
                                    echo 'Enregistrement pays';
                                }
                                
                            ?></center>
                        </h5>
                        <div class="card-body">
                        <div class="row">
          <div class="col-lg-12">
            <div class="p-1">
            <form action="<?php  
                                if (isset($_GET['operation']) && ($_GET['operation'] == 'modification') ) {
                                    echo 'traitement/update-pays.php?id='.$id ;
                                } else {
                                    echo 'traitement/add-pays.php ';
                                }
                                
                            ?>" method="post" enctype="multipart/form-data" >
                    <section class="row">
                        <div class="form-group col-md">
                            <input type="text" name="nomlieu" id="" class="form-control" placeholder="Nom du pays" <?php  if (@$_GET['operation'] == 'modification') {
                                    echo 'value="' .$pays['nom'].'"';
                                } ?> required>
                        </div>
                    </section>
                    <section class="row">
                        <div class="form-group col-md">
                            <input type="number" name="lng" id="" class="form-control" placeholder="longitude" <?php  if (@$_GET['operation'] == 'modification') {
                                    echo 'value="' .$pays['lng'].'"';
                                } ?> required> 
                        </div>
                        <div class="form-group col-md">
                            <input type="number" name="lat" id="" class="form-control" placeholder="latitude" <?php  if (@$_GET['operation'] == 'modification') {
                                    echo 'value="' .$pays['lat'].'"';
                                } ?> required>
                        </div>
                    </section>
                    <section class="row">
                        <div class="form-group col-md">
                        <textarea class="form-control form-control-user " rows="5" id="descriptionlieu" name="descriptionlieu" placeholder="Description..." style="resize:none"><?php  if (@$_GET['operation'] == 'modification') {
                                    echo  $pays['description'];
                                } ?></textarea>
                        </div>
                    </section>
                    <section class="row">
                        <div class="form-group  col">
                        <?php 
                                    if (@$_GET['operation'] == 'modification') 
                                    {
                                        echo'<label for="image">Nom Image:</label>
                                        <p>'.$pays['img'].'</p>
                                        <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image" required>
                                        <label for="image" class="custom-file-label">Sélectionner une nouvelle image:</label>
                                        </div>';
                                    }
                                    else{
                                        echo'<div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image" required>
                                        <label class="custom-file-label" for="image">Choisir un fichier</label>
                                        <div class="invalid-feedback"> <?php?></div>
                                        <span class="help-inline"><?php echo $imageError;?></span>
                                        </div>';
                                    }
                                    ?>
                          </div>
                    </section>
                    <section class="row form-group d-flex justify-content-end">
                        <section class="">
                            <button type="reset" class="btn btn-danger"> Annuler</button>
                        </section>
                        <section class="ml-3 mr-3">
                            <button type="submit" class="btn btn-outline-warning"><?php if (isset($_GET['operation'])) {
                                    echo 'Modifier';
                                    
                                } else {
                                    echo 'Ajouter';
                                }?></button>
                        </section>
                    </section>
                </form>
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
            <?php require'include/footer.php';?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

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

</html>