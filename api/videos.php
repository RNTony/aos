<?php
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
        	$requete2 = $pdo->prepare("SELECT vid_nom, vid_id, id_user FROM videos");
			$requete2->execute();
			$resultats2 = $requete2->fetchAll();

			$retour2["videos"]["donnee"] = $resultats2; 
			$retour2["videos"]["nb de videos"] = count($resultats2);

			retour_json(true,'Donnees videos',$retour2);
			http_response_code(200);
}

/*else if ($_SERVER['REQUEST_METHOD'] == "POST") {}

else if ($_SERVER['REQUEST_METHOD'] == "PUT") {}

else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {}*/

	?>