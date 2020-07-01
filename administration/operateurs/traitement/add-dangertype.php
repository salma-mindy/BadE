<?php
    session_start();  
    require_once "../../../database/db.php"; 
    var_dump(@$_POST);
 if (!empty(@$_POST))
        {
                $tdanger   = strip_tags($_POST['dangertype']);
                $req = $db->prepare('SELECT intitule FROM dangertype');
                $req->execute();
                $typedanger = $req->fetchAll();
                foreach ($typedanger as $bddanger) {
                    if (strcasecmp($bddanger['intitule'],$tdanger) == 0)
                    {
                        $_SESSION['echec']= 'is-invalid';
                        $_SESSION['infoechec'] ='cette valeur existe dejà, consulter la liste des Type';
                        header ("location:../be-tdanger.php");
                        break;
                    }
                    
                }
                //$bddanger = $typedanger['intitule'];
                //var_dump($typedanger);
                //var_dump(strcasecmp($bddanger,$tdanger) == 0);
                $newtype = [
                    'typeDanger' => $tdanger, 
                    'id'        => $_SESSION['id'],
                    'datemodif' => date("Y-m-d H:i:s"),
                    'dateajout' => date("Y-m-d H:i:s")
                ];
                $typeprepare=$db->prepare("INSERT  INTO dangertype(intitule, idUtilisateur, dateAjout, dateModification) VALUES (:typeDanger, :id, :dateajout, :datemodif)");
                
                $insert = $typeprepare->execute($newtype);
                echo '<hr> danger inserer';
                var_dump($insert);
                if(@$insert)
                {
                    /*unset($_POST);
                    $newActivite = [
                        ':activite'     => 'Ajout de type de danger',
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
         
        } else
        {
            @$erreurType ='';
        }
?>