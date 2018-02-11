<?php
  //Activer le gestionnaire de session
    session_start();

  if (!empty($_POST['submit'])) {
    $login=$_POST['login'];
    $password=$_POST['password'];

    //Connection base de donnée avec PDO
    try {
      $dsn = 'mysql:host=localhost;dbname=aos;charset=utf8';
      $user = 'root';
      $pass = 'root';

      $options = array();// Tableau des options

      //Creer une instance de PDO
      $dbh = new PDO($dsn,$user,$pass,$options);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      // La requete SQL
      $query = "SELECT * FROM users WHERE users_login = '$login' AND users_mdp = '$password'";

      // Lancer la requete :renvoie une instance de PDOStatement
      $stmt = $dbh->query($query);

      // Definir le mode de fetch
      $stmt->setFetchMode(PDO::FETCH_OBJ);

      //tester si on a un utilisateur ou pas
      if($stmt->rowCount()==1){
        // récuperer l'objet qui contient les données
        $odata = $stmt->fetch();

          //Compte actif ou pas?
        if($odata->users_active == 1){
          //Test des droits
          switch($odata->users_role){
            case 'ADMIN': header("Location: ../page-user.php?login=$login&password=$password");
            exit;
            break;

            case 'USER': header("Location: ../page-user.php");
            exit;
            break;

          }
        }
        else{
          //Le compte est inactif
          $msg = "Login ou mot de passe incorrect";

          //Redirection
          header("location:" . "connexion.php?msg=$msg");
          exit;
        }

      }
      else {
        //Aucun utilisateur
        $msg = "Login ou mot de passe incorrect";

        //Redirection
        header("location:" . "connexion.php?msg=$msg");
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
