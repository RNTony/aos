<?php
include 'includes/header.php';

$requete2 = $pdo->prepare("SELECT img_nom, img_id, id_user FROM images");
$requete2->execute();
$resultats2 = $requete2->fetchAll();

$retour2["images"]["donnee"] = $resultats2; 
$retour2["images"]["nb d'images"] = count($resultats2);


//var_dump($retour);
echo json_encode($retour2);

?>