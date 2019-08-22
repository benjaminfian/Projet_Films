<?php
include '../include/header.php';
require_once("../BD/connexion.inc.php");
require_once("../librairies/gestionFichiers.inc.php");

$num=$_POST['num'];
$titre=$_POST['titre'];
$res=$_POST['res'];
$categ=$_POST['categ'];
$duree=$_POST['duree'];
$prix=$_POST['prix'];
$tmp=$_FILES['pochette']['tmp_name'];
$trailer = substr($_POST['trailer'], -11);
$requete="SELECT image FROM film WHERE idFilm=?";
$stmt=$connexion->prepare($requete);
$stmt->execute(array($num));
$ligne=$stmt->fetch(PDO::FETCH_OBJ);
$pochette=$ligne->image;
if($tmp !== "")
{	
	$dossier='../pochettes/';
	if($pochette !== "avatar.png")
    {
		enleverFichier($dossier,$pochette);
	}
	$nomPochette=sha1($titre.time());
	$pochette=deposerFichier("pochette",$dossier,$nomPochette);
}
$requete="UPDATE film SET titre=?,realisateur=?,categorie=?,prix=?,duree=?,image=?,trailer=? WHERE idFilm=?";
$stmt=$connexion->prepare($requete);
$stmt->execute(array($titre,$res,$categ,$prix,$duree,$pochette,$trailer,$num));
echo "Le film numero $num a bien été modifié";	
?>

<?php
include '../include/footer.php';
?>

<meta http-equiv="refresh" content="1; url=lister.php" />
