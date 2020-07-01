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
                if(@$insert)
                {
                    /*unset($_POST);
                    $newActivite = [
                        ':activite'     => 'Modification de type de danger',
                        ':dateactivite' => date("Y-m-d H:i:s"),
                        ':iduser'       => $_SESSION['idUtilisateur']
                    ];
                    #var_dump($newActivite);
                    $activite = "INSERT  INTO activite (nomActivite, dateActivite, idUtilisateur) VALUES ( :activite, :dateactivite, :iduser)";
                    #var_dump($activite);
                    $rActivite = $db->prepare($activite)->execute($newActivite);
                    $_SESSION['success'] = 'true';
                    $_SESSION['echec']= '';*/
                    header ("location:../be-tdanger.php");  
                }else{
                    @$erreurType ='';
                    $echec ='Ajout non effectué';
                }
            }
        
?>