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
                            <center>Ajout d'informations</center>
                        </h5>
                        <div class="card-body">
                        <div class="row">
          <div class="col-lg-12">
            <div class="p-1">
              <form method="post" class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- champ description lieu danger-->
                  <div class="mt-3">
                      <h5 style="color: #ffc500">Description du lieu</h5>
                  </div>
                  <hr>
                  <div class="form-group row mb-2">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <div class="col" style="border-radius:10rem;display:inline-block;overflow:hidden;background:#464141;border:1px solid #000;padding: .7rem 1.5rem">
                          <select name="paysId" id="paysId"  onChange="combo(this, 'pays')" onMouseOut="comboInit(this, 'pays')" style="width:100%;height:100%;border:0px;outline:none;background:#464141;color:#fff;font-size: .8rem;">
                              <option>-- Choisir le pays --</option>
                              <?php
                                  require_once "../../database/db.php";
                                  $stmt = $db->query('SELECT id,nom FROM pays ORDER BY nom');
                                  while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                                      echo "<option value='$row->id'>$row->nom</option>";
                                  }
                              ?>
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-6 mb-1 mb-sm-0" >
                      <div class="col" style="border-radius:10rem;display:inline-block;overflow:hidden;background:#464141;border:1px solid #000;padding: .7rem 1.5rem">
                          <select id="ville" name="ville" style="width:100%;height:100%;border:0px;outline:none;background:#464141;color:#fff;font-size: .8rem;">
                              <option>-- Choisir la ville --</option>
                          </select>
                      </div>
                    </div>
                  </div>
                <!-- champ description du danger-->
                <div class="">
                    <h5 style="color: #ffc500">Informations générale</h5>
                </div>
                <hr>
                <div class="form-group row ">
                  <?php                    
                    $sql_td = "SELECT * FROM dangertype";
                    $query_td = $db->prepare($sql_td);
                    $query_td->execute();
                    $data_td = $query_td->fetchAll();
                    ?>  
                  <div class="col-sm-4">
                    <select name="dangerType" id="dangerType" class="form-control">
                        <option value="" selected> <em>-- Type de danger --</em></option>
                        <?php  foreach($data_td as $res_td): ?>
                            <option value="<?php echo $res_td['id'];?>"><?php echo $res_td['intitule'];?></option>
                        <?php endforeach; ?>
                    </select>
                     
                    <small style="color: #ff1300 !important">
                        <center>
                            <i><?php echo $dangerType_err; ?></i>
                        </center>
                    </small>
                  </div>
                  <div class="col-sm-4 mb-3">
                    <input type="date" class="form-control" id="date" name="date" placeholder="Indiquez la date">
                    <small style="color: #ff1300 !important">
                        <center>
                            <i><?php echo $date_err; ?></i>
                        </center>
                    </small>
                  </div>
                    <div class="col-sm-4 mb-3 mb-sm-0">
                      <input type="text" class="form-control" id="source" name="source" placeholder="Veuillez indiquer la Source">
                      <small style="color: #ff1300 !important">
                          <span class="align-items-center text-center">
                              
                          </span>
                      </small> 
                   </div>
                  </div>
                
                <div class="form-group">
                  <textarea class="form-control " rows="5" id="description" name="description" placeholder="Description..." style="resize:none"></textarea>
                  <small style="color: #ff1300 !important">
                        <center>
                            <i><?php echo $description_err; ?></i>
                        </center>
                  </small>
                </div>
                <!-- champ description des acteurs du danger-->
                <div class="mt-3">
                    <h5 style="color: #ffc500">Information sur les différents acteurs</h5>
                </div>
                <hr>
                <div class="form-group row ">
                    <?php
                        $sql_a = "SELECT * FROM acteurs";
                        $query_a = $db->prepare($sql_a);
                        $query_a->execute();
                        $data_a = $query_a->fetchAll();
                    ?>  
                  
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <select name="sexeVictime" id="sexeVictime" class="form-control">
                        <option value="" selected> <em>-- victimes --</em></option>
                        <?php  foreach($data_a as $res_a): ?>
                            <option value="<?php echo $res_a['id'];?>"><?php echo $res_a['intitule'];?></option>
                        <?php endforeach; ?>
                    </select>
                    <small style="color: #ff1300 !important">
                        <center>
                            <i><?php echo $sexeVictime_err; ?></i>
                        </center>
                    </small> 
                 </div>
                  <div class="col-sm-6 mb-sm-0">
                        <select name="sexeResponsable" id="sexeResponsable" class="form-control">
                            <option value="" selected> <em>-- Responsable --</em></option>
                            <?php  foreach($data_a as $res_a): ?>
                                <option value="<?php echo $res_a['id'];?>"><?php echo $res_a['intitule'];?></option>
                            <?php endforeach; ?>
                        </select>             
                        <small style="color: #ff1300 !important">
                            <center>
                                <i><?php echo $sexeResponsable_err; ?></i>
                            </center>
                        </small>
                  </div>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-primary btn-user btn-block" style="background: #ff1300!important; color:#fff;" value="Enregister">
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
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
