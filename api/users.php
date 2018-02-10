

<?php
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
		//if ($_GET['url'] == "users") {
        	$requete = $pdo->prepare("SELECT * FROM users");
			$requete->execute();
			$resultats = $requete->fetchAll();
			$retour["Utilisateur"]["donnee"] = $resultats; 
			$retour["Utilisateur"]["nb d'utilisateur"] = count($resultats);

        	retour_json(true,'Données utilisateur',$retour);
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


else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {}*/

?>