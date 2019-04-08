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
    echo "Informations invalide";
    unset($connexion);
	unset($stmt);
	exit;
}
session_start();
$_SESSION['user']=$email;
echo "Vous etes connecte avec le compte ".$_SESSION['user'];
unset($connexion);
unset($stmt);
?>

<br><br><a href="../index.php">Retour a la page d'accueil</a>


