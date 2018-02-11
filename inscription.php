<?php
  //Activer le gestionnaire de session
    session_start();

  if (!empty($_POST['inscription'])) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $login=$_POST['login'];
    $password=$_POST['password'];
    $mail = $_POST['mail'];
    //Connection base de donnée avec PDO
    try {
    include 'bdd.php';

      // La requete SQL
      $queryI = "INSERT INTO users (users_id, users_nom, users_prenom, users_login, users_mdp, users_active, users_role, users_mail)
      VALUES('','$nom', '$prenom', '$login', '$password', 1, 'USER', '$mail')";

      $query = "SELECT * FROM users WHERE users_nom='$nom' AND users_prenom='$prenom' AND users_login = '$login' AND users_mdp = '$password'";

      // Lancer la requete :renvoie une instance de PDOStatement
      $stmt = $dbh->query($query);

      // Definir le mode de fetch
      $stmt->setFetchMode(PDO::FETCH_OBJ);

      //tester si on a un utilisateur ou pas
      if($stmt->rowCount()==1){
        // récuperer l'objet qui contient les données
        $odata = $stmt->fetch();

        //Déjà présent utilisateur
        $msg = "alert";

        //Redirection
        header("location:" . "../page-signup.php?msg=$msg");
        exit;
      }
      else {

              $dbh->query($queryI);
              //Redirection
              $nom = strtoupper($nom);
              $prenom = ucfirst(strtolower($prenom));
              $msg="success";
              header("location:" . "../page-signup.php?msg=$msg&nom=$nom&prenom=$prenom");

              exit;

      }


    }
      //Renvoie un PDOException
    catch (PDOException $e) {
      //Appel de la methode getMessage() de PDOException
      echo $e->getMessage().   "<br/>";
    }
  }
?>
