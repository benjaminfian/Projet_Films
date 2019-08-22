<?php
require_once("../BD/connexion.inc.php");
$email=$_POST['login'];
$pw=$_POST['pass'];

$requete = "SELECT * FROM connexion WHERE email=? AND pw=?";
$stmt=$connexion->prepare($requete);
$stmt->execute(array($email,$pw));
$ligne=$stmt->fetch(PDO::FETCH_OBJ);
if ($ligne == null)
{
    include '../include/header.php';
    echo "Informations invalide";
    unset($connexion);
	unset($stmt);
	exit;
}
session_start();
$_SESSION['user']=$email;
$_SESSION['pageLogin']=1;

$idMembre = $ligne->idMembre;
$requete = "SELECT * FROM membre WHERE idMembre=?";
$stmt=$connexion->prepare($requete);
$stmt->execute(array($idMembre));
$ligne=$stmt->fetch(PDO::FETCH_OBJ);

$panier = json_encode($ligne->panier);

include '../include/header.php';
echo "Vous etes connecte avec le compte ".$_SESSION['user'];

echo '<script type="text/javascript">',
     'chargerPanier('.$panier.');',
     '</script>';
?>

<?php
include '../include/footer.php';
unset($_SESSION['pageLogin']);
?>

<meta http-equiv="refresh" content="1; url=<?php echo $_SERVER["HTTP_REFERER"]  ; ?>" />


