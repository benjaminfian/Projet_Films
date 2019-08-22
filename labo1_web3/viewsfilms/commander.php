<?php
include '../include/header.php';
require_once("../BD/connexion.inc.php");

if(isset($_SESSION['user']))
{
	$panier=$_POST['panier'];
	$membre=$_SESSION['user'];

	$requete="SELECT * FROM connexion WHERE email = ?";
	$stmt = $connexion->prepare($requete);
	$stmt->execute(array($membre));
	$ligne=$stmt->fetch(PDO::FETCH_OBJ);
	$idMembre = $ligne->idMembre;

	$panier = json_decode($_POST['panier']);

	for ($i = 0; $i < sizeof($panier); $i++)
	{
		$idFilm = $panier[$i]->id;
		$quantite = $panier[$i]->quantite;
		$requete="INSERT INTO location VALUES(0,?,?,?,now())";
		$stmt = $connexion->prepare($requete);
		$stmt->execute(array($idFilm,$idMembre,$quantite));    
	}
	$panier = "";
	$requete="UPDATE membre SET panier=? WHERE idMembre=?";
    $stmt=$connexion->prepare($requete);
    $stmt->execute(array($panier,$idMembre));
}

echo "Merci pour votre commande";

?>

<?php
include '../include/footer.php';
?>

<meta http-equiv="refresh" content="1; url=<?php echo $_SERVER["HTTP_REFERER"]  ; ?>" />