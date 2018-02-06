<?php
header('Content-Type: application/json');

try { 
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=aos','root','');
	//$retour["success"] = true;
	//$retour["message"] = "Connexion reussie";
}
 catch (Exception $e) {
				$retour["success"] = false;
				$retour["message"] = "Connexion impossible";
		}	

$requete = $pdo->prepare("SELECT * FROM users");
$requete->execute();
$resultats = $requete->fetchAll();

$retour["Utilisateur"]["donnee"] = $resultats; 
$retour["Utilisateur"]["nb d'utilisateur"] = count($resultats);


//var_dump($retour);
echo json_encode($retour);

/*$requete = $pdo->prepare("SELECT * FROM images");
$requete->execute();
$resultats = $requete->fetchAll();

$retour["images"]["donnee"] = $resultats; 
$retour["images"]["nb d'imgages"] = count($resultats);


var_dump($retour);
echo json_encode($retour);
*/
?>