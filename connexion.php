<?php
  //Activer le gestionnaire de session
  session_start();

  if (!empty($_POST['submit'])) {
    $login=$_POST['login'];
    $password=$_POST['password'];

    //Connection base de donnée avec PDO
    try {
      $dsn = 'mysql:host=localhost;dbname=aos;charset=utf8';
      $user = 'root'; $pass = '';
      
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
        
          //Creer la variable de session nom
          $_SESSION['nom'] = $odata->users_nom;
          $_SESSION['active'] = $odata->users_active;
          $_SESSION['auth'] = $odata->users_login;

          //Compte actif ou pas?
        if($odata->users_active == 1){
          //Test des droits
          switch($odata->users_role){
            case 'ADMIN': header("Location: index.php");
            exit;
            break;
            
            case 'USER': header("Location: index.php");
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



<!doctype html>
<html>
<head>
  <title>Connexion</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" 
          href="bootstrap/css/bootstrap.min.css" 
        media="screen">
        
  <link href="bootstrap/css/moncss.css" rel="stylesheet" media="screen"/>

</head>

<body>
  
<br/>
<br/>
<h1> Connexion </h1>
<form method="post" action="connexion.php" class="form-inline connexion">
    
    <div class="form-group">
      <h4><label for="login">Login</label>
    <input type ="text" id="login" name ="login" class="form-control mx-sm-3">
    &nbsp;
      <label for="inputPassword4">Password</label>
      <input type="password" id="inputPassword4" name="password" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
      &nbsp;
      <button type = "submit" id="submit" name="submit" class="btn btn-primary" value="Connexion">Connexion</button></h4>
    </div>
    <?php
    if(isset($_GET['msg'])) {
      echo "<p style='color : yellow';>" . $_GET['msg'] . "</p>";
    }

  ?>
</form>

      
 <?php include ('includes/footer.php');?> 