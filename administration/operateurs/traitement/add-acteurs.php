 
<?php
    // Initialisation de la section
    session_start();
    require_once "../../../database/db.php";
     
 if (!empty(@$_POST))
        {
                $acteurs   = strip_tags($_POST['acteurs']);
                var_dump($acteurs);
                $req = $db->prepare('SELECT intitule FROM acteurs WHERE intitule = ?');
                $acteur = $req->execute([$acteurs]);
                $acteur= $req->fetchAll(PDO::FETCH_ASSOC);
                $nombreligne = $req->rowCount(); //verifier si l'on trouve une valeur après la requette
                var_dump($nombreligne);
                
                echo '<hr> verification';
                @$bddanger = @$intitule['intitule'];
                foreach($acteur as $intitule){ $bddanger = $intitule['intitule'];};
                @$bddanger = @$intitule['intitule'];
                var_dump(@$bddanger);
                var_dump($acteurs);
                echo '<hr> verification';
                var_dump(strcasecmp($bddanger,$acteurs) == 0);
        if (strcasecmp(@$intitule['intitule'],$acteurs) == 0 || $nombreligne !== 0){
                $_SESSION['echec']= 'is-invalid';
                $_SESSION['acteursivalid']= $acteurs;
                $_SESSION['infoechec'] ='cette valeur existe dejà, consulter la liste des acteurs';
                header ("location:../be-acteur.php");  
            }else
            {
                $newacteur = [
                    'intitule' => $acteurs, 
                    'id'        => $_SESSION['id'],
                    'datemodif' => date("Y-m-d H:i:s"),
                    'dateajout' => date("Y-m-d H:i:s")
                ];
                $acteurprepare=$db->prepare("INSERT  INTO acteurs (intitule, idUtilisateur, dateModification, dateAjout) VALUES (:intitule, :id, :datemodif, :dateajout)");
                $insert = $acteurprepare->execute($newacteur);
                echo '<hr> danger inserer';
                echo '<hr> verification3';
                var_dump($insert);
                //Enregistrement activité si mise à jour réussi.
                if ($insert) {
                    $newActivite = [
                        ':activite'     => 'Enregistrement d\'acteur',
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
                        header("location:../be-acteur.php");
                    } else {
                        $_SESSION['alerte']= "error";
                        header("location:../be-acteur.php");
                    }
                    
                    }
                    $_SESSION['alerte']= "error";
                header ("location:../be-acteur.php");
                }
            }
        } else
        {
            @$erreuracteur ='';
        }
?>