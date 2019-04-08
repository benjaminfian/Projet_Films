<?php
session_start();
session_unset();
session_destroy();
echo "Vous etes deconnecté";
?>

<br><br><a href="../index.php">Retour a la page d'accueil</a>