<?php
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
        	$requete2 = $pdo->prepare("SELECT comvid_id,comm,id_date,id_friend,id_vid FROM vid_comments");
			$requete2->execute();
			$resultats2 = $requete2->fetchAll();

			$retour2["coms"]["donnee"] = $resultats2; 
			$retour2["coms"]["nb de coms"] = count($resultats2);

			retour_json(true,'Donnees coms img',$retour2);
			http_response_code(200);
}

/*else if ($_SERVER['REQUEST_METHOD'] == "POST") {}

else if ($_SERVER['REQUEST_METHOD'] == "PUT") {}

else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {}*/

	?>