<?php
include '../include/header.php';
require_once("../BD/connexion.inc.php");

function envoyerFiche($num,$titre,$res,$categ,$duree,$prix)
{
$rep=   '<div class="container">
            <form id="enregForm" enctype="multipart/form-data" action="modifier.php" method="POST" onSubmit="return valider();">                   
                      <h4>modifier un film</h4>                                   
                        <div class="form-group">
                            Numero :<input type="text" class="form-control" id="num" name="num" value="'.$num.'" readonly><br>
                            Titre:<input type="text" class="form-control" id="titre" name="titre" value="'.$titre.'"><br>
                            Realisateur :<input type="text" class="form-control" id="res" name="res" value="'.$res.'"><br>                        
                            Categorie :<select class="form-control" id="categ" name="categ">
                                <option selected hidden>"'.$categ.'"</option>
                                <option>Action</option>                            
                                <option>Drame</option>
                                <option>Horreur</option>                            
                                <option>Science-fiction</option>
                            </select><br>
                            Duree :<input type="number" class="form-control" id="duree" name="duree" value="'.$duree.'" min="0"><br>
                            prix :<input type="number" class="form-control" id="prix" name="prix" value="'.$prix.'" min="0"><br>
                            <label for="pochette">image de la pochette : </label>
                            <input type="file" class="form-control-file" id="pochette" name="pochette">
                        </div>                
                      <button type="submit" class="btn btn-primary" >Modifier</button>          			
              </form>
        </div>';
echo $rep;
}

function obtenirFiche(){
	global $connexion;
	$num=$_POST['idModifier'];
	$requete="SELECT * FROM film WHERE idFilm=?";
	$stmt=$connexion->prepare($requete);
	$stmt->execute(array($num));
	$ligne=$stmt->fetch(PDO::FETCH_OBJ);
	if($ligne == null){
		echo "Film ".$num." introuvable";
		unset($connexion);
		unset($stmt);
		exit;
	}
	$titre=$ligne->titre;
	$res=$ligne->realisateur;
    $categ=$ligne->categorie;
    $duree=$ligne->duree;
    $prix=$ligne->prix;
	unset($connexion);
	unset($stmt);
	envoyerFiche($num,$titre,$res,$categ,$duree,$prix);
}
obtenirFiche();
?>

<br><br><a href="lister.php">Retour a la liste des films</a>

<?php
include '../include/footer.php';
?>