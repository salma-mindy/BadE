<?php
  session_start();
  require_once "../../../database/db.php";
     if(!empty($_GET['id'])) 
     {
         $id = strip_tags($_GET['id']);
         $statement = $db->prepare("DELETE FROM dangertype WHERE id = ?");
         $resultat = $statement->execute(array($id));
         //Enregistrement activité si mise à jour réussi.
         if ($resultat) {
            $newActivite = [
                ':activite'     => 'Suppression de type de danger',
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