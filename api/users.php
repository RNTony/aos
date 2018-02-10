

<?php
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
		

        	$requete = $pdo->prepare("SELECT * FROM users");
			$requete->execute();
			$resultats = $requete->fetchAll();
			$retour["Utilisateur"]["donnee"] = $resultats; 
			$retour["Utilisateur"]["nb d'utilisateur"] = count($resultats);

        	retour_json(true,'Donnees utilisateur',$retour);
        	http_response_code(200);
        }

/*else if ($_SERVER['REQUEST_METHOD'] == "POST") {
    	
                $postBody = file_get_contents("php://input");
                $postBody = json_decode($postBody);

                
				$users_active = $postBody->users_active;				
				//$users_id				
				$users_login = $postBody->users_login;
				$users_mdp = $postBody->users_mdp;
				$users_nom = $postBody->users_nom;
				$users_prenom = $postBody->users_prenom;
				$users_role = $postBody->users_role;
                } 

                else {
                        http_response_code(401);
                        }

else if ($_SERVER['REQUEST_METHOD'] == "PUT") {}

*/
else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
	if(isset($_GET['id'])&& !empty( $_GET['id'] )){
        $id=$_GET['id'];

	 
         //Requete SQL pour supprimer l'user dans la base
        $req = "DELETE FROM users WHERE users_id = '$id'";
          
        //execution de la requete et obtention d'un statement
        $stmt = $pdo->query($req);

        //mode de fetch
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        http_response_code(200);        

        $requete = $pdo->prepare("SELECT * FROM users");
			$requete->execute();
			$resultats = $requete->fetchAll();
			$retour["Utilisateur"]["donnee"] = $resultats; 
			$retour["Utilisateur"]["nb d'utilisateur"] = count($resultats);

        	retour_json(true,'Données utilisateur',$retour);
        }

    else {
    	http_response_code(404);
    	retour_json(false,'ID NON VALIDE');

    }
}
    
?>