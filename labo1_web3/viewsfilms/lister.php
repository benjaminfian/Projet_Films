<?php
include '../include/header.php';
?>

    
    
    
    <!-- The Modal -->
      <div class="modal fade" id="form_enreg">
        <div class="modal-dialog">
            <form id="enregForm" enctype="multipart/form-data" action="enregistrer.php" method="POST">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Enregistrer un nouveau film</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="titre" name="titre" placeholder="titre du film" required><br>
                            <input type="text" class="form-control" id="res" name="res" placeholder="nom du realisateur" required><br>                        
                            <select class="form-control" id="categ" name="categ" required>
                                <option selected hidden>catégorie</option>
                                <option>Action</option>                            
                                <option>Drame</option>
                                <option>Horreur</option>                            
                                <option>Science-fiction</option>
                            </select><br>
                            <input type="number" class="form-control" id="duree" name="duree" placeholder="durée du film (min)" min="0" required><br>
                            <input type="text" class="form-control" id="prix" name="prix" placeholder="prix de la location" min="0" required><br>
                            Lien de la vidéo de la bande annonce : <input type="url" class="form-control" id="trailer" name="trailer" placeholder="https://example.com" required><br>
                            <label for="pochette">image de la pochette : </label>
                            <input type="file" class="form-control-file" id="pochette" name="pochette">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" >Enregistrer</button>
                    </div>        
                </div>				
              </form>      
        </div>
      </div>    
    
<?php
$dossier="../pochettes/";
$rep='<div class="row marge-gauche custom-center">        
        <div class="col-sm-12 col-md-10 col-md-offset-1 custom-center"><br>
            <button type="button" class="btn btn-success marge-bas" data-toggle="modal" data-target="#form_enreg">Ajouter</button>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Pochette</th>
                        <th class="text-center">Titre</th>
                        <th class="text-center">Réalisateur</th>
                        <th class="text-center">Catégorie</th>
                        <th class="text-center">Durée</th>
                        <th class="text-center">Prix</th>
                        <th class="text-left">Gestion</th>
                        <th></th></tr>
                </thead>
                <tbody>';
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
            $rep.='<tr>
                    <td class="col-sm-1 col-md-1">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> 
                                <img class="img_crud" src="../pochettes/'.($ligne->image).'" alt="Film '.($ligne->categorie).'" title="image de la boite du film '.($ligne->titre).'">
                            </a>                            
                        </div>
                    </td>
                    <td class="col-sm-1 col-md-1 text-center"><strong>'.($ligne->titre).'</strong></td>
                    <td class="col-sm-1 col-md-1 text-center"><strong>'.($ligne->realisateur).'</strong></td>
                    <td class="col-sm-1 col-md-1 text-center"><strong>'.($ligne->categorie).'</strong></td>
                    <td class="col-sm-1 col-md-1 text-center"><strong>'.($ligne->duree).' min</strong></td>
                    <td class="col-sm-1 col-md-1 text-center"><strong>'.($ligne->prix).' $</strong></td>
                    <td class="col-sm-1 col-md-1">                         
                        <form id="formFiche" action="fiche.php" method="POST">
                            <input type="hidden" name="idModifier" value="'.($ligne->idFilm).'">
                            <input type="submit" class="btn btn-success" value="Modifier">
                        </form>                                                
                    </td>
                    <td class="col-sm-1 col-md-1">
                        <form action="enlever.php" method="POST">
                            <input type="hidden" name="idSupprimer" value="'.($ligne->idFilm).'">
                            <input type="submit" class="btn btn-danger" value="Supprimer">                            
                        </form>
                    </td>
                </tr>';					 
		 }
	 }
    catch (Exception $e)
    {
		echo "Probleme pour lister";
	 }
    finally 
    {
		$rep.='</tbody></table></div></div></div>';		
		echo $rep;        
	 }
?>


<?php
include '../include/footer.php';
?>