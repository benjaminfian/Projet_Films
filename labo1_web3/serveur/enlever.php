<?php
require_once("../BD/connexion.inc.php");
$num=$_POST['idSupprimer'];
$requete="SELECT image FROM film WHERE idFilm=?";
$stmt=$connexion->prepare($requete);
$stmt->execute(array($num));
$ligne=$stmt->fetch(PDO::FETCH_OBJ);
if($ligne == null)
{
	echo "Film ".$num." introuvable";
	unset($connexion);
	unset($stmt);
	exit;
}
$pochette=$ligne->image;
if ($pochette !== "avatar.png"){
		$rmPoc='../pochettes/'.$pochette;
		$tabFichiers = glob('../pochettes/*');
		//print_r($tabFichiers);
		// parcourir les fichier
		foreach($tabFichiers as $fichier)
        {
		  if(is_file($fichier) && $fichier==trim($rmPoc)) 
          {
			// enlever le fichier
			unlink($fichier);
			break;
		  }
		}
}
//Enlever de la table films
$requete="DELETE FROM film WHERE idFilm=?";
$stmt=$connexion->prepare($requete);
$stmt->execute(array($num));
echo "Film $num a ete enleve";
?>
<br><br><a href="lister.php">Retour a la liste des films</a>