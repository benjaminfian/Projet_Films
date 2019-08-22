<?php
include '../include/header.php';
require_once("../BD/connexion.inc.php");
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$email=$_POST['email'];
$dateNaissance=$_POST['dateNaissance'];
$sexe=$_POST['sexe'];
$pass=$_POST['pass'];

$requete="SELECT * FROM connexion WHERE email = ?";
$stmt = $connexion->prepare($requete);
$stmt->execute(array($email));
$ligne=$stmt->fetch(PDO::FETCH_OBJ);

if ($ligne == null)
{
$requete="INSERT INTO membre VALUES(0,?,?,?,?,?)";
$stmt = $connexion->prepare($requete);
$stmt->execute(array($nom,$prenom,$dateNaissance,$sexe,""));
$idMembre = $connexion->lastInsertId();
echo "Membre ".$idMembre." bien enregistré";

$requete="INSERT INTO connexion VALUES(?,?,0,?)";
$stmt = $connexion->prepare($requete);
$stmt->execute(array($email,$pass,$idMembre));
$idMembre = $connexion->lastInsertId();
}
else
{    
    echo "Ce membre existe est déja enregistrer dans notre base de donnée. Entrer une adresse mail différente.";
}
?>

<?php
include '../include/footer.php';
?>

<meta http-equiv="refresh" content="1; url=<?php echo $_SERVER["HTTP_REFERER"]  ; ?>" />
