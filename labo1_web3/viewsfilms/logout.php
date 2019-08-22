<?php
session_start();
require_once("../BD/connexion.inc.php");
session_unset();
session_destroy();

include '../include/header.php';
echo "Vous etes deconnecté";
?>

<?php
include '../include/footer.php';
?>

<meta http-equiv="refresh" content="1; url=../index.php" />