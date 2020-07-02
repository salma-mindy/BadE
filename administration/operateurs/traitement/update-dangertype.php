<?php
    session_start();  
 
    require_once "../../../database/db.php";
    var_dump(@$_POST);
 if (!empty(@$_POST))
        {
                $tdanger   = strip_tags($_POST['dangertype']);
                $id = strip_tags($_GET['id']);
                var_dump($id);
                $typeprepare=$db->prepare("UPDATE dangertype SET intitule=?, dateModification=? WHERE id=?");
                $insert = $typeprepare->execute([$tdanger, date("Y-m-d H:i:s"), $id]);
                var_dump($insert);
                if ($insert) {
                $newActivite = [
                    ':activite'     => 'Mise à jour de type de danger',
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
                    header("location:../be-tdanger.php");
                 } else {
                    $_SESSION['alerte']= "error";
                    header("location:../be-tdanger.php");
                 }
                 
                }
                $_SESSION['alerte']= "error";
            header ("location:../be-tdanger.php");
            }
            }
        
?>