<?php
include 'includes/header.php';

$requete = $pdo->prepare("SELECT * FROM users");
$requete->execute();
$resultats = $requete->fetchAll();

$retour["Utilisateur"]["donnee"] = $resultats; 
$retour["Utilisateur"]["nb d'utilisateur"] = count($resultats);


//var_dump($retour);
echo json_encode($retour);

/*$requete2 = $pdo->prepare("SELECT img_id, img_nom, id_users FROM images");
$requete2->execute();
$resultats2 = $requete2->fetchAll();

$retour2["images"]["donnee"] = $resultats2; 
$retour2["images"]["nb d'imgages"] = count($resultats2);


//var_dump($retour);
echo json_encode($retour2);*/

?>