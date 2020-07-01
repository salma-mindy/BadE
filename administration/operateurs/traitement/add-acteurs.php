 
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
                if(@$insert)
                {
                    header ("location:../be-acteur.php");  
                }else{
                    @$erreuracteur ='';
                    $echec ='Ajout non effectué';
                }
            }
        } else
        {
            @$erreuracteur ='';
        }
?>