<?php
require_once("../BD/connexion.inc.php");
$titre=$_POST['titre'];
$res=$_POST['res'];
$categ=$_POST['categ'];
$duree=$_POST['duree'];
$prix=$_POST['prix'];
$dossier="../pochettes/";
$nomPochette=sha1($titre.time());
$pochette="avatar.png";
if($_FILES['pochette']['tmp_name']!==""){
	//Upload de la photo
	$tmp = $_FILES['pochette']['tmp_name'];
	$fichier= $_FILES['pochette']['name'];
	$extension=strrchr($fichier,'.');
	@move_uploaded_file($tmp,$dossier.$nomPochette.$extension);
	// Enlever le fichier temporaire chargé
	@unlink($tmp); //effacer le fichier temporaire
	$pochette=$nomPochette.$extension;
}
$requete="INSERT INTO film VALUES(0,?,?,?,?,?,?)";
$stmt = $connexion->prepare($requete);
$stmt->execute(array($titre,$res,$categ,$prix,$duree,$pochette));
echo "Film ". $connexion->lastInsertId()." bien enregistre";
unset($connexion);
unset($stmt);
?>
<br><br><a href="../accueil.html">Retour a l'accueil</a>