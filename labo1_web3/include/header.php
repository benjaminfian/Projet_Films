<?php
if(!isset($_SESSION['pageLogin']))
{
    session_start();
}
if($_SERVER['PHP_SELF'] == "/labo1_web3/index.php")
{
    require_once("BD/connexion.inc.php");
}
else
{
    require_once("../BD/connexion.inc.php");
}
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
if($_SERVER['PHP_SELF'] == "/labo1_web3/index.php")
{
    echo '<html>
<head>
    <title>Films</title>    
    <meta charset="utf-8">  
	<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/general.js"></script>
    <script src="js/panier.js"></script>    
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.min">
	<link rel="stylesheet" href="css/bootstrap-reboot.min">
	<link rel="stylesheet" href="css/monCSS.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
</head>
    
<body class="bg-white" onload="load()">';
}
else
{
    echo '<html>
<head>
    <title>Films</title>    
    <meta charset="utf-8">  
	<script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
    <script src="../js/general.js"></script>
    <script src="../js/panier.js"></script>    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-grid.min">
	<link rel="stylesheet" href="../css/bootstrap-reboot.min">
	<link rel="stylesheet" href="../css/monCSS.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
</head>
    
<body class="bg-white" onload="load()">';
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light marge-bas">
<div class="container-fluid">
<?php
if($_SERVER['PHP_SELF'] == "/labo1_web3/index.php")
{
    echo '<a class="navbar-brand text-dark" href="index.php"><img src="images/logo.png" height="100px" width="100px"/></a>';
}
else
{
    echo '<a class="navbar-brand text-dark" href="../index.php"><img src="../images/logo.png" height="100px" width="100px"/></a>';
}
?>  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item navbar-collapse active">
<?php
if($_SERVER['PHP_SELF'] == "/labo1_web3/index.php")
{
    echo '<a class="nav-link" href="index.php">Accueil</a>';
}
else
{
    echo '<a class="nav-link" href="../index.php">Accueil</a>';
}
?>        
      </li>      
      <li class="nav-item navbar-collapse dropdown">
        <a class="nav-link dropdown-toggle text-dark" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Vidéothèque</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">          
<?php
if ($_SESSION['statut'] == "admin")
{
    echo '<a class="dropdown-item" onclick="lister(1)" href="#">Action</a>          
          <a class="dropdown-item" onclick="lister(2)" href="#">Drame</a>
		  <a class="dropdown-item" onclick="lister(3)" href="#">Horreur</a>
		  <a class="dropdown-item" onclick="lister(4)" href="#">Science fiction</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" onclick="lister()" href="#">Toutes les catégories</a>          
        </div>';
    if($_SERVER['PHP_SELF'] == "/labo1_web3/index.php")
    {
        echo '<form id="form_listeFilmAction" action="viewsfilms/lister.php" method="POST">
              <input type="hidden" name="categorie" value="Action"></form>
            <form id="form_listeFilmDrame" action="viewsfilms/lister.php" method="POST">
              <input type="hidden" name="categorie" value="Drame"></form>
            <form id="form_listeFilmHorreur" action="viewsfilms/lister.php" method="POST">
              <input type="hidden" name="categorie" value="Horreur"></form>
            <form id="form_listeFilmSF" action="viewsfilms/lister.php" method="POST">
              <input type="hidden" name="categorie" value="Science-fiction"></form>
            <form id="form_listeFilm" action="viewsfilms/lister.php" method="POST"></form>
        </li> ';
    }
    else
    {
        echo '<form id="form_listeFilmAction" action="lister.php" method="POST">
              <input type="hidden" name="categorie" value="Action"></form>
            <form id="form_listeFilmDrame" action="lister.php" method="POST">
              <input type="hidden" name="categorie" value="Drame"></form>
            <form id="form_listeFilmHorreur" action="lister.php" method="POST">
              <input type="hidden" name="categorie" value="Horreur"></form>
            <form id="form_listeFilmSF" action="lister.php" method="POST">
              <input type="hidden" name="categorie" value="Science-fiction"></form>
            <form id="form_listeFilm" action="lister.php" method="POST"></form>
        </li> ';
    }
               
}
else
{
    echo '<a class="dropdown-item" onclick="lister(1)" href="#">Action</a>
          <a class="dropdown-item" onclick="lister(2)" href="#">Drame</a>
		  <a class="dropdown-item" onclick="lister(3)" href="#">Horreur</a>
		  <a class="dropdown-item" onclick="lister(4)" href="#">Science fiction</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" onclick="lister()" href="#">Toutes les catégories</a>
        </div>';
    
        if($_SERVER['PHP_SELF'] == "/labo1_web3/index.php")
        {
            echo '<form id="form_listeFilmAction" action="viewsfilms/categories.php" method="POST">
          <input type="hidden" name="categorie" value="Action"></form>
        <form id="form_listeFilmDrame" action="viewsfilms/categories.php" method="POST">
          <input type="hidden" name="categorie" value="Drame"></form>
        <form id="form_listeFilmHorreur" action="viewsfilms/categories.php" method="POST">
          <input type="hidden" name="categorie" value="Horreur"></form>
        <form id="form_listeFilmSF" action="viewsfilms/categories.php" method="POST">
          <input type="hidden" name="categorie" value="Science-fiction"></form>
        <form id="form_listeFilm" action="viewsfilms/categories.php" method="POST"></form>
    </li>';
        }
        else
        {
            echo '<form id="form_listeFilmAction" action="categories.php" method="POST">
          <input type="hidden" name="categorie" value="Action"></form>
        <form id="form_listeFilmDrame" action="categories.php" method="POST">
          <input type="hidden" name="categorie" value="Drame"></form>
        <form id="form_listeFilmHorreur" action="categories.php" method="POST">
          <input type="hidden" name="categorie" value="Horreur"></form>
        <form id="form_listeFilmSF" action="categories.php" method="POST">
          <input type="hidden" name="categorie" value="Science-fiction"></form>
        <form id="form_listeFilm" action="categories.php" method="POST"></form>
    </li>';
        }
        
}
?>
            
<?php
if ($_SESSION['statut'] == "membre")
{
    if($_SERVER['PHP_SELF'] == "/labo1_web3/index.php")
    {
        echo '<li class="nav-item navbar-collapse active">
        <a class="nav-link" href = "viewsfilms/panier.php">Panier</a>
      </li>	  
	  <li class="nav-item navbar-collapse">
        <a class="nav-link" href="viewsfilms/panier.php" tabindex="-1" aria-disabled="true"><img src="images/panier.svg" class="img_nav"/><span id="totalPanier"></span></a>
      </li>';
    }
    else
    {
        echo '<li class="nav-item navbar-collapse active">
        <a class="nav-link" href = "panier.php">Panier</a>
      </li>	  
	  <li class="nav-item navbar-collapse">
        <a class="nav-link" href="panier.php" tabindex="-1" aria-disabled="true"><img src="../images/panier.svg" class="img_nav"/><span id="totalPanier"></span></a>
      </li>';
    }   
}
?>
	  
    </ul>
    <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
<?php
if ($_SESSION['statut'] == "visiteur")
{
    if($_SERVER['PHP_SELF'] == "/labo1_web3/index.php")
    {
        echo '<li class="nav-item order-2 order-md-1">                    
                    <button type="button" id="connexion" name="connexion" class="btn nav-link" data-toggle="modal" data-target="#form_enregMembre">
                        <img src="images/devenirMembre.png" class="img_nav"><span class="noir">Devenir membre</span>
                        <span class="caret"></span>
                    </button>
                </li>
                <li class="navbar-collapse dropdown order-1">
                    <button type="button"data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle"><span class="noir">Se connecter</span><span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right mt-2">
                       <li class="px-3 py-2">
                           <form class="form" role="form" id="connexionForm" enctype="multipart/form-data" action="viewsfilms/login.php" method="POST">
                                <div class="form-group">
                                    <input id="login" name="login" type="email" placeholder="Courriel" class="form-control form-control-sm" type="email" required>
                                </div>
                                <div class="form-group">
                                    <input id="pass" name="pass" type="password" placeholder="mot de passe" class="form-control form-control-sm" type="text" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Connection</button>
                                </div>                                
                            </form>
                        </li>
                    </ul>
                </li>';
    }
    else
    {
        echo '<li class="nav-item order-2 order-md-1">                    
                    <button type="button" id="connexion" name="connexion" class="btn nav-link" data-toggle="modal" data-target="#form_enregMembre">
                        <img src="../images/devenirMembre.png" class="img_nav"><span class="noir">Devenir membre</span>
                        <span class="caret"></span>
                    </button>
                </li>
                <li class="navbar-collapse dropdown order-1">
                    <button type="button"data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle"><span class="noir">Se connecter</span><span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right mt-2">
                       <li class="px-3 py-2">
                           <form class="form" role="form" id="connexionForm" enctype="multipart/form-data" action="login.php" method="POST">
                                <div class="form-group">
                                    <input id="login" name="login" type="email" placeholder="Courriel" class="form-control form-control-sm" type="email" required>
                                </div>
                                <div class="form-group">
                                    <input id="pass" name="pass" type="password" placeholder="mot de passe" class="form-control form-control-sm" type="text" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Connection</button>
                                </div>                                
                            </form>
                        </li>
                    </ul>
                </li>';
    }    
}
else if ($_SESSION['statut'] == "membre" OR $_SESSION['statut'] =="admin")
{
    if($_SERVER['PHP_SELF'] == "/labo1_web3/index.php")
    {
        echo '<li class="nav-item navbar-collapse order-2 order-md-1">
            <h5 class="text-center">'.$_SESSION['user'].'</h5>                    
                </li>
                <li class="dropdown navbar-collapse order-1">
                    <button type="button" id="deconnexion" name="deconnexion" class="btn nav-link" onclick="deconnexion()">
                        <img src="images/deconnection.png" class="img_nav"><span class="noir">Se déconnecter</span>
                        <span class="caret"></span>
                    </button>
                    <form id="form_logout" action="viewsfilms/logout.php" method="POST">                        
                    </form>
                </li>';
    }
    else
    {
        echo '<li class="nav-item navbar-collapse order-2 order-md-1">
            <h5 class="text-center">'.$_SESSION['user'].'</h5>                    
                </li>
                <li class="dropdown navbar-collapse order-1">
                    <button type="button" id="deconnexion" name="deconnexion" class="btn nav-link" onclick="deconnexion()">
                        <img src="../images/deconnection.png" class="img_nav"><span class="noir">Se déconnecter</span>
                        <span class="caret"></span>
                    </button>
                    <form id="form_logout" action="logout.php" method="POST">                        
                    </form>
                </li>';
    }   
}
?>               
    </ul>
    </div>
    </div>
    </nav>
    
    <div class="modal fade" id="form_enregMembre">
        <div class="modal-dialog">
<?php
if($_SERVER['PHP_SELF'] == "/labo1_web3/index.php")
{
    echo '<form id="form_enregMembre" enctype="multipart/form-data" action="viewsfilms/enregistrerMembre.php" method="POST">';
}
else
{
    echo '<form id="form_enregMembre" enctype="multipart/form-data" action="enregistrerMembre.php" method="POST">';
}        
?>
            
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
      