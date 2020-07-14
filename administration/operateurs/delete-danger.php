<?php
require_once "../../database/db.php";

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $sql = "DELETE FROM danger WHERE id='$id' ";
    $query = $db->prepare($sql);
    $resultat = $query -> execute();
    if ($resultat) {
        $newActivite = [
            ':activite'     => 'Enregistrement de type de danger',
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
            header ("location:../liste-des-danger-ajouter.php");
        } else {
            $_SESSION['alerte']= "error";
            header ("location:../liste-des-danger-ajouter.php");
        }
        
        }
        $_SESSION['alerte']= "error";
    header ("location:../liste-des-danger-ajouter.php");
    }
    
}
exit;
?>