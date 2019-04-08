<?php
require_once("../BD/connexion.inc.php");
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$email=$_POST['email'];
$dateNaissance=$_POST['dateNaissance'];
$sexe=$_POST['sexe'];
$pass=$_POST['pass'];

$requete="INSERT INTO membre VALUES(0,?,?,?,?)";
$stmt = $connexion->prepare($requete);
$stmt->execute(array($nom,$prenom,$dateNaissance,$sexe));
$idMembre = $connexion->lastInsertId();
echo "membre ".$idMembre." bien enregistré";

$requete="INSERT INTO connexion VALUES(?,?,0,?)";
$stmt = $connexion->prepare($requete);
$stmt->execute(array($email,$pass,$idMembre));
$idMembre = $connexion->lastInsertId();

unset($connexion);
unset($stmt);
?>

<br><br><a href="../accueil.php">Retour a accueil</a>


