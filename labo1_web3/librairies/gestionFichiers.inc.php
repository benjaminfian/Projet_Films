<?php
function enleverFichier($dossier,$leFichier){
	$tabFichiers = glob($dossier.'*');
	$rmFic=$dossier.$leFichier;
	// parcourir les fichier
	foreach($tabFichiers as $fichier){
	  if(is_file($fichier) && $fichier==trim($rmFic)) {
		// enlever le fichier
		unlink($fichier);
		break;
	  }
	}
}
function deposerFichier($inputName,$dossier,$nomPochette){
	$tmp = $_FILES[$inputName]['tmp_name'];
	$fichier= $_FILES[$inputName]['name'];
	$extension=strrchr($fichier,'.');
	@move_uploaded_file($tmp,$dossier.$nomPochette.$extension);
	// Enlever le fichier temporaire chargé
	@unlink($tmp); //effacer le fichier temporaire
	$pochette=$nomPochette.$extension;
	return $pochette;
}
?>