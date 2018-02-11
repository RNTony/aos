<html>
<body>
<!-- formulaire pour ajouter une image -->
<form action="upload.php" method="post" >
				<table>
					<tr>
						<th><h3>Ajouter une photo</h3></th>
					</tr>
					<tr>
						<td><h4>Titre:</h4> </td>
						<td>
							<input type="text" name="titre" />
						</td>
					</tr>
					<!-- <tr>
						<td><h4>Commentaire :  :</h4></td>
						<td><input type="text" name="commentaire" /></td>
					</tr>-->
					<tr>
						<td><h4>Selectionner une image: </h4>
						<input type="file" name="monImage" /><br />
						</td>
					</tr>
					
						

						<tr>
						<td><input type="submit" class="btn btn-primary" value="Ajouter"/> </td>
						
					</tr>
				</table>
</form>
</body>
</html>
<!--
//include 'includes/header.php';
 //session_start();
//ici on recupere les données du formulaire
  //$titre=$_POST['titre'];
   // $commentaire=$_POST['commentaire'];
	//$monImage =$_POST['monImage'];
// requete pour inserer mon image dans ma bdd
//$ajoutImage ="insert into image(`img_id`, `img_blob`, `img_nom`, `id_user`) VALUES ('','','$titre','$_SESSION['auth']');";
	//$result_image = $dbh->query($ajoutImage);
	//$res_Image = $result_image->fetch(PDO::FETCH_OBJ);
	 -->