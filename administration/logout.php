<?php
    // Initialisation de la section
    session_start();
    // Annulation de toutes les variables de session
    $_SESSION = array();
   // var_dump($_SESSION);exit();
   $newActivite = [
    ':activite'     => 'Deconnextion Opérateur',
    ':dateactivite' => date("Y-m-d H:i:s"),
    ':iduser'       => $_SESSION['id']
];
$activite = "INSERT  INTO activites (intituleActivite, periode, idUtilisateur) VALUES ( :activite, :dateactivite, :iduser)";
$rActivite = $db->prepare($activite)->execute($newActivite);
    // Destruction de la section
    session_destroy();
 
    // Redirection vers la page de connexion
    header("location: ./index.php");
    exit;
?>