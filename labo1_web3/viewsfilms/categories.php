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

<?php
$rep='<div class="row mt-5 justify-content-center">';
if(isset($_POST['categorie']))
{    
     $requette="SELECT * FROM film WHERE categorie = '".$_POST['categorie']."'";
}
else
{
    $requette="SELECT * FROM film";
}
    try
    {
		 $stmt = $connexion->prepare($requette);
		 $stmt->execute();
		 while($ligne=$stmt->fetch(PDO::FETCH_OBJ))
         {
             if(isset($_SESSION['user'])) 
             {
                 $rep.='<div class="card mx-2 mb-3 text-center">
                            <img src="../pochettes/'.$ligne->image.'" alt="'.$ligne->titre.'" class="card-img-top img_location video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/'.$ligne->trailer.'" data-target="#preview">
                            <div class="card-body">
                                <h5 class="card-title text-titre">'.$ligne->titre.'</h5>
                                <p class="card-text">'.$ligne->realisateur.'</p>
                                <p class="card-text">'.$ligne->categorie.'</p>
                                <p class="card-text">'.$ligne->prix.' $</p>
                                Quantité : <select id="quantite'.$ligne->idFilm.'">
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                    <option value=5>5</option>
                                    <option value=6>6</option>
                                    <option value=7>7</option>
                                    <option value=8>8</option>
                                    <option value=9>9</option>
                                    <option value=10>10</option>
                                </select><br><br>
                                <button type="button" id="ajouter" name="ajouter" value="Ajouter" class="btn btn-success" onclick="ajouter(\''.$ligne->image.'\',\''.$ligne->titre.'\','.$ligne->prix.','.$ligne->idFilm.')">Ajouter</button>
                            </div>
                        </div>';
             }
             else
             {
                 $rep.='<div class="card mx-2 mb-3 text-center">
                            <img src="../pochettes/'.$ligne->image.'" alt="'.$ligne->titre.'" class="card-img-top img_location video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/'.$ligne->trailer.'" data-target="#preview">
                            <div class="card-body">
                                <h5 class="card-title text-titre">'.$ligne->titre.'</h5>
                                <p class="card-text text-info">'.$ligne->realisateur.'</p>
                                <p class="card-text text-info">'.$ligne->categorie.'</p>
                                <p class="card-text text-info">'.$ligne->prix.' $</p>                            
                            </div>
                        </div>';
             }            					 
		 }
	 }
    catch (Exception $e)
    {
		echo "Probleme pour lister";
	 }
    finally 
    {
		$rep.='</div>';		
		echo $rep;        
	 }
?>

<!-- Modal -->
<div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">      
      <div class="modal-body">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>        
        <!-- 16:9 aspect ratio -->
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
</div>        
      </div>
    </div>
  </div>
</div> 

<form id="form_sauver" action="categories.php" method="POST">
    <input id="sauverPanier" name="sauverPanier" type="hidden">
</form>

<?php
include '../include/footer.php';
?>
         
          

    


    
    
