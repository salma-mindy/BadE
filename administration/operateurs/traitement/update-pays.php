<?php
       session_start();
       require_once "../../../database/db.php";
       var_dump($_POST);
       if (!empty($_POST)) {
        $nomlieu          =strip_tags($_POST['nomlieu']);
        $descriptionlieu  =strip_tags($_POST['descriptionlieu']);
        $image            =strip_tags($_FILES["image"]["name"]);
        $imagePath        = '../image/lieu/pays/'. basename($image);
        $imageExtension   = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess        = true;
        $isUploadSuccess  = false;
  
        if (empty($nomlieu)) {
                $_SESSION['errorlieu'] ='is-invalid';
                $isSuccess = false;
                $_SESSION['lieuInvalid']="";
            }   
        if (empty($descriptionlieu)) {
                $_SESSION['errordesclieu'] ='is-invalid';
                $isSuccess = false;
                $_SESSION['desclieuInvalid']="";
            }
    if(empty($image)) // le input file est vide, ce qui signifie que l'image n'a pas ete update
        {
            $isImageUpdated = false;
            echo'<hr>';
        }
        else
        {
            echo'<hr>';
            $isImageUpdated = true;
            $isUploadSuccess =true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" && $imageExtension != "PNG" && $imageExtension != "JPG" && $imageExtension != "JPEG" && $imageExtension != "GIF") 
            {
                    $_SESSION['imageInvalid'] = "is-invalid";
                    $_SESSION['imageError'] = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                    echo "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                    $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 5000000) 
            {
                $_SESSION['imageInvalid']= "is-invalid";
                $_SESSION['imageError'] = "Le fichier ne doit pas depasser les 500KB";
                echo "Le fichier ne doit pas"; 
            }
            if($isUploadSuccess) 
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath ) )
                    {
                        $_SESSION['imageInvalid'] = "is-invalid";
                        $_SESSION['imageError'] = "Il y a eu une erreur lors de l'upload";
                        echo "Il y a eu une erreur lors de l'upload";
                        $isUploadSuccess = false;
                    } 
            } 
        }

        var_dump($isSuccess);
        var_dump($isUploadSuccess);
        var_dump($isSuccess && $isImageUpdated && $isUploadSuccess);
        var_dump($isSuccess && !$isImageUpdated);
        if (($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated))
            {
                 
            if($isImageUpdated)
            {
                $newlieu = [
                    'id'                   => $_GET['id'],
                    'nomLieu'              => $nomlieu,
                    'descriptionlieu'      => $descriptionlieu,
                    'lat'                  => $_POST['lat'],
                    'lng'                  => $_POST['lng'],
                    'imagelieu'            => $image,
                    'dernieremodif'        => date("Y-m-d H:i:s")
                ];
                $updatelieu = "UPDATE  pays  SET    nom=:nomLieu, lng=:lng, lat=:lat, descriptionPays=:descriptionlieu, img=:imagelieu , dateModification=:dernieremodif WHERE id=:id";
               $resultat = $db->prepare($updatelieu)->execute($newlieu);      
            }
            else
            {
                $newlieu = [
                    'id'                   => $_GET['id'],
                    'nomLieu'              => $nomlieu,
                    'descriptionlieu'      => $descriptionlieu,
                    'lat'                  => $_POST['lat'],
                    'lng'                  => $_POST['lng'],
                    'dernieremodif'        => date("Y-m-d H:i:s")
                ];
                $updatelieu = "UPDATE  pays  SET    nom=:nomLieu, lng=:lng, lat=:lat, descriptionPays=:descriptionlieu, dateModification=:dernieremodif WHERE id=:id";
               $resultat = $db->prepare($updatelieu)->execute($newlieu);
            }
            if ($resultat) {
            $newActivite = [
                ':activite'     => 'Mise à jour de Pays',
                ':dateactivite' => date("Y-m-d H:i:s"),
                ':iduser'       => $_SESSION['id']
            ];
            var_dump($newActivite);
            $activite = "INSERT  INTO activites (intituleActivite, periode, idUtilisateur) VALUES ( :activite, :dateactivite, :iduser)";
            if ($resultat) {
            var_dump($activite);
            $rActivite = $db->prepare($activite)->execute($newActivite);
            var_dump($rActivite);
             if ($rActivite) {
                $_SESSION['alerte']= "success";
                header("location:../liste-pays.php");
             } else {
                $_SESSION['alerte']= "error";
                header("location:../liste-pays.php");
             }
             
            }
            $_SESSION['alerte']= "error";
            header ("location:../liste-pays.php");
        }
            }
            
               
            header ("location:../ajouter-pays.php");           
            

        } else {
            header ("location:../ajouter-pays.php");           
        }
?>