<?php
include '../include/header.php';
?>

<?php
if(isset($_SESSION['user']))
{
	if(isset($_POST['sauverPanier']))
	{
		$panier=$_POST['sauverPanier'];	
		$membre=$_SESSION['user'];

		$requete="SELECT * FROM connexion WHERE email = ?";
		$stmt = $connexion->prepare($requete);
		$stmt->execute(array($membre));
		$ligne=$stmt->fetch(PDO::FETCH_OBJ);
		$idMembre = $ligne->idMembre;

		$requete="UPDATE membre SET panier=? WHERE idMembre=?";
		$stmt=$connexion->prepare($requete);
		$stmt->execute(array($panier,$idMembre));
	}    
}
?>


<div id="contenu">
</div>

<form id="form_commande" action="commander.php" method="POST">        
    <input type="hidden" id="panier" name="panier">
</form>

<form id="form_sauver" action="panier.php" method="POST">
    <input id="sauverPanier" name="sauverPanier" type="hidden">
</form>
    
<?php
include '../include/footer.php';
?>