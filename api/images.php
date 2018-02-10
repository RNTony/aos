<?php
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
        	$requete2 = $pdo->prepare("SELECT img_nom, img_id, id_user FROM images");
			$requete2->execute();
			$resultats2 = $requete2->fetchAll();

			$retour2["images"]["donnee"] = $resultats2; 
			$retour2["images"]["nb d'images"] = count($resultats2);

			retour_json(true,'Données images',$retour2);
			http_response_code(200);
        }

/*else if ($_SERVER['REQUEST_METHOD'] == "POST") {}

else if ($_SERVER['REQUEST_METHOD'] == "PUT") {}

else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {}*/
?>