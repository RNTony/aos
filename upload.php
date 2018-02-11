<?php
if($_FILES['monImage'])
{
     $dossier = 'upload/';
     $fichier = basename($_FILES['monImage']['name']);
     if(move_uploaded_file($_FILES['monImage']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
//On fait un tableau contenant les extensions autorisées.
//Comme il s'agit d'un avatar pour l'exemple, on ne prend que des extensions d'images.
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
// récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
$extension = strrchr($_FILES['monImage']['name'], '.');

//Ensuite on teste
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
}
// taille maximum (en octets)
$taille_maxi = 100000;
//Taille du fichier
$taille = filesize($_FILES['monImage']['tmp_name']);
if($taille>$taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
}
$fichier = strtr($fichier,
     'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
     'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
//On remplace les lettres accentutées par les non accentuées dans $fichier.
//Et on récupère le résultat dans fichier

//En dessous, il y a l'expression régulière qui remplace tout ce qui n'est pas une lettre non accentuées ou un chiffre
//dans $fichier par un tiret "-" et qui place le résultat dans $fichier.
$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
?>
