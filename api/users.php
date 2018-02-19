

<?php
include '../includes/header.php';



//SI LA REQUETE EST UN GET
if ($_SERVER['REQUEST_METHOD'] == "GET") {
		
        	$requete = $pdo->prepare("SELECT * FROM users");
			$requete->execute();
			$resultats = $requete->fetchAll();
			$retour["Utilisateur"]["donnee"] = $resultats; 
			$retour["nombre d'utilisateur"] = count($resultats);

        	retour_json(true,'Donnees utilisateur',$retour);
        	http_response_code(200);
        }




else if ($_SERVER['REQUEST_METHOD'] == "POST") {
    			// definition des champs à remplir
                $postBody = file_get_contents("php://input");
                $postBody = json_decode($postBody);

                $users_active = $postBody->users_active;				
				$users_login = $postBody->users_login;
				$users_mdp = $postBody->users_mdp;
				$users_nom = $postBody->users_nom;
				$users_prenom = $postBody->users_prenom;
				$users_role = $postBody->users_role;


					// verifie si les champs existent
					if(!empty($users_active && $users_role && $users_login && $users_prenom && $users_nom && $users_mdp)) {

					$query='INSERT INTO users(users_active, users_login, users_mdp, users_nom, users_prenom, users_role) VALUES(:users_active, :users_login, :users_mdp, :users_nom, :users_prenom, :users_role)';
				        $req = $pdo->prepare($query);

				        // Attacher les parametres
				        $req->bindParam(':users_active',$users_active);
				       	$req->bindParam(':users_login',$users_login);
				       	$req->bindParam(':users_mdp',$users_mdp);
				        $req->bindParam(':users_nom',$users_nom);
						$req->bindParam(':users_prenom',$users_prenom);
				        $req->bindParam(':users_role',$users_role);

				        //execution de la requete
				        $req ->execute();

				        //affichage json apres requete
				        $requete = $pdo->prepare("SELECT * FROM users");
						$requete->execute();
						$resultats = $requete->fetchAll();
						$retour["Utilisateur"]["donnee"] = $resultats; 
						$retour["nombre d'utilisateur après ajout"] = count($resultats);

				        http_response_code(200);
				        retour_json(true,'utilisateur ajouté',$retour);
                    } 

                 	else {
                		retour_json(false,"information erronee");
                        http_response_code(400);
                        }
}
               



else if ($_SERVER['REQUEST_METHOD'] == "PUT") {
	if(isset($_GET['id'])&& !empty( $_GET['id'] )){
        $id=$_GET['id'];

				// definition des champs à remplir
                $postBody = file_get_contents("php://input");
                $postBody = json_decode($postBody);

                $users_active = $postBody->users_active;				
				$users_login = $postBody->users_login;
				$users_mdp = $postBody->users_mdp;
				$users_nom = $postBody->users_nom;
				$users_prenom = $postBody->users_prenom;
				$users_role = $postBody->users_role;


					// verifie si les champs existent
					if(!empty($users_active && $users_role && $users_login && $users_prenom && $users_nom && $users_mdp)) {


					$req = $pdo->prepare('UPDATE users SET users_active=:users_active, users_login=:users_login, users_mdp=:users_mdp, users_nom=:users_nom, users_prenom=:users_prenom, users_role=:users_role WHERE users_id = :users_id');

				    $req->execute(array('users_active' => $users_active, 'users_login' => $users_login, 'users_mdp' => $users_mdp, 'users_nom' => $users_nom, 'users_prenom' => $users_prenom, 'users_role' => $users_role, 'users_id' => $id));
				
				        //affichage json apres requete
				        $requete = $pdo->prepare("SELECT * FROM users");
						$requete->execute();
						$resultats = $requete->fetchAll();
						$retour["Utilisateur"]["donnee"] = $resultats; 
						$retour["nombre d'utilisateur"] = count($resultats);

				        http_response_code(200);
				        retour_json(true,'utilisateur mis à jour',$retour);
                    }


                 	else {
                		retour_json(false,"information erronee");
                        http_response_code(400);
                        }
	}	
else {
                		retour_json(false,"pb id");
                        http_response_code(400);
                        }
}




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
			$retour["nombre d'utilisateur après DELETE"] = count($resultats);

        	retour_json(true,'Données utilisateur après DELETE',$retour);
        }
    
    else {
    	http_response_code(404);
    	retour_json(false,'ID NON VALIDE');
    }
}
else {
    	http_response_code(404);
    	retour_json(false,'ID NON VALIDE');
    }
    
?>