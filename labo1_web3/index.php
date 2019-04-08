<?php
session_start();
require_once("BD/connexion.inc.php");
if(isset($_SESSION['user']))
{
    $requette="SELECT * FROM connexion WHERE email=?";
    try
    {         
	    $stmt = $connexion->prepare($requette);
        $stmt->execute(array($_SESSION['user']));
        $ligne=$stmt->fetch(PDO::FETCH_OBJ);
        $statut=$ligne->admin;      
        if ($statut == 1)
        {
            $_SESSION['statut'] = 'admin';
        }
        else
        {
            $_SESSION['statut'] = 'membre';
        }
    }
    catch (Exception $e)
    {
		echo "Probleme d'acces a la table connexion";
    }
}
else
{
    $_SESSION['statut'] = 'visiteur';
}
?>
<html>
<head>
    <title>Films</title>    
    <meta charset="utf-8">  
	<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/general.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.min">
	<link rel="stylesheet" href="css/bootstrap-reboot.min">
	<link rel="stylesheet" href="css/monCSS.css">    
</head>
    
<body class="bg-white">
    
<nav class="navbar navbar-expand-lg navbar-light bg-light"><img src="images/logo.png" height="100px" width="100px"/>
  <a class="navbar-brand text-dark" ><h3>&nbsp;&nbsp;FilmShop</h3></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto custom-center">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Accueil</a>
      </li>      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-dark" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="">Vidéothèque</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            
<?php
if ($_SESSION['statut'] == "admin")
{
    echo '<a class="dropdown-item" href="">Action</a>
          <a class="dropdown-item" href="">Drame</a>
		  <a class="dropdown-item" href="">Horreur</a>
		  <a class="dropdown-item" href="">Science fiction</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="" onclick="lister()">Toutes les catégories</a>
        <form id="form_listeFilm" action="viewsfilms/lister.php" method="POST"/>';        
}//
else
{
    echo '<a class="dropdown-item" >Action</a>
          <a class="dropdown-item" >Drame</a>
		  <a class="dropdown-item" >Horreur</a>
		  <a class="dropdown-item" >Science fiction</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item">Toutes les catégories</a>';
}
?>
          
        </div>
      </li>
<?php
if ($_SESSION['statut'] == "membre")
{
    echo '<li class="nav-item active">
        <a class="nav-link" href = "panier.php">Panier</a>
      </li>	  
	  <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><img src="images/panier.svg" class="img_nav"/><span id="totalPanier"></span></a>
      </li>';
}
?>
	  
    </ul>
    <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
<?php
if ($_SESSION['statut'] == "visiteur")
{
    echo '<li class="nav-item order-2 order-md-1">                    
                    <button type="button" id="connexion" name="connexion" class="btn nav-link" data-toggle="modal" data-target="#form_enregMembre">
                        <img src="images/devenirMembre.png" class="img_nav">Devenir membre
                        <span class="caret"></span>
                    </button>
                </li>
                <li class="dropdown order-1">
                    <button type="button"data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle">Se connecter <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right mt-2">
                       <li class="px-3 py-2">
                           <form class="form" role="form" id="connexionForm" enctype="multipart/form-data" action="viewsfilms/login.php" method="POST" onSubmit="return validerConnexion();">
                                <div class="form-group">
                                    <input id="login" name="login" placeholder="Courriel" class="form-control form-control-sm" type="email" required>
                                </div>
                                <div class="form-group">
                                    <input id="pass" name="pass" placeholder="mot de passe" class="form-control form-control-sm" type="text" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Connection</button>
                                </div>                                
                            </form>
                        </li>
                    </ul>
                </li>';
}
else if ($_SESSION['statut'] == "membre" OR $_SESSION['statut'] =="admin")
{
    echo '<li class="nav-item order-2 order-md-1">
            <h5 class="text-center">'.$_SESSION['user'].'</h5>                    
                </li>
                <li class="dropdown order-1">
                    <button type="button" id="deconnexion" name="deconnexion" class="btn nav-link" onclick="deconnexion()">
                        <img src="images/deconnection.png" class="img_nav">Se déconnecter
                        <span class="caret"></span>
                    </button>
                    <form id="form_logout" action="viewsfilms/logout.php" method="POST"/>
                </li>';
}
?>               
    </ul>
    </div>
    </nav>   
    <form id="form_logout" action="viewsfilms/logout.php" method="POST"/>
  <div id="contenu">  
      <?php
      $rep ="";
      if ($_SESSION['statut'] == "admin")
      {
          $rep.="<h1>bienvenue admin</h1>";
      }
      else if(($_SESSION['statut'] == "membre"))
      {
          $rep.="<h1>bienvenue membre</h1>";
      }
      else 
      {
          $rep.="<h1>bienvenue visiteur</h1>";
      }
      
      echo $rep;
      ?>      
      
    <!-- The Modal -->
      <div class="modal fade" id="form_enregMembre">
        <div class="modal-dialog">
            <form id="form_enregMembre" enctype="multipart/form-data" action="viewsfilms/enregistrerMembre.php" method="POST">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Entrez vos informations personnelles :</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrer votre nom" required><br>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrer votre prenom" required><br>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrer votre adresse courriel" required><br>
                            Date de naissance :<input type="date" class="form-control" id="dateNaissance" name="dateNaissance" required><br>
                            Genre : <label class="radio-inline"><input type="radio" id="sexe" name="sexe" value="M" required> Homme </label>
                            <label class="radio-inline"><input type="radio" name="sexe" value="F"> Femme </label><br>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Entrer votre mot de passe" required><br>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" >S'inscrire</button>
                    </div>        
                </div>				
              </form>      
        </div>
      </div>            
      
      <div class="card-deck bordure">          
              
            <div class="card">
                <a href="viewsfilms/categories.php">
                    <img  class="card-img-top img_accueil"  src="images/logo.png" >
                </a>
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;color:red;">Action</h5>
                </div>
            </div>
          
          <div class="card">
                <a href="viewsfilms/categories.php">
                    <img  class="card-img-top img_accueil"  src="images/logo.png" >
                </a>
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;color:red;">Drame</h5>
                </div>
            </div>
          
          <div class="card">
                <a href="viewsfilms/categories.php">
                    <img  class="card-img-top img_accueil"  src="images/logo.png" >
                </a>
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;color:red;">Horreur</h5>
                </div>
            </div>
          
          <div class="card">
                <a href="viewsfilms/categories.php">
                    <img  class="card-img-top img_accueil"  src="images/logo.png" >
                </a>
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;color:red;">Science fiction</h5>
                </div>
            </div>
          
      </div>              
    </div>        
          
<div><p>&nbsp;&nbsp;Collège Maisonneuve, groupe 16701 / Benjamin Fian</p></div>
    
</body>
</html>

<?php
unset($connexion);
unset($stmt);
?>
    


    
    
