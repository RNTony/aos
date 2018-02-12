<?php
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
        	$requete2 = $pdo->prepare("SELECT * FROM vid_comments");
			$requete2->execute();
			$resultats2 = $requete2->fetchAll();

			$retour2["coms"]["donnee"] = $resultats2; 
			$retour2["coms"]["nb de coms"] = count($resultats2);

			retour_json(true,'Donnees coms vid',$retour2);
			http_response_code(200);
}

/*else if ($_SERVER['REQUEST_METHOD'] == "POST") {}

else if ($_SERVER['REQUEST_METHOD'] == "PUT") {}*/

else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
	if(isset($_GET['id'])&& !empty( $_GET['id'] )){
        $id=$_GET['id'];

	 
         //Requete SQL pour supprimer dans la base
        $req = "DELETE FROM vid_comments WHERE comvid_id = '$id'";
          
        //execution de la requete et obtention d'un statement
        $stmt = $pdo->query($req);
        //mode de fetch
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        http_response_code(200);        

        $requete2 = $pdo->prepare("SELECT comvid_id,comm,id_date,id_friend,id_vid FROM vid_comments");
		$requete2->execute();
		$resultats2 = $requete2->fetchAll();

		$retour2["coms"]["donnee"] = $resultats2; 
		$retour2["coms"]["nb de coms"] = count($resultats2);

		retour_json(true,'Donnees coms vid',$retour2);
    }
        

    else {
    	http_response_code(404);
    	retour_json(false,'ID NON VALIDE');
    }
}

	?>