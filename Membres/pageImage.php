<?php

if(!isset($_SESSION)) {
	session_start();
}
$errorMessage = '';

// chargeur de classes
function chargerClasseMembre($className) {
	file_exists((dirname(dirname(__FILE__))).'/Membres/'.$className.'.class.php') &&
	require (dirname(dirname(__FILE__))).'/Membres/'.$className.'.class.php';
}
function chargerClasseGroupe($className) {
	file_exists((dirname(dirname(__FILE__))).'/Groupes/'.$className.'.class.php') &&
	require (dirname(dirname(__FILE__))).'/Groupes/'.$className.'.class.php';
}
spl_autoload_register('chargerClasseGroupe');
spl_autoload_register('chargerClasseMembre');


require ('../Erreur.class.php');

// Verifie l'integrite de la page
if(!isset($_GET['groupe']) || !is_numeric($_GET['groupe']) || $_GET['groupe'] < 0) {
	$errorMessage = 'Aucun groupe demand�';
} else {
	//Connection a la base de donnee
	include (dirname(dirname(__FILE__)).'/dbConnection.php');

	// Manager d'images
	$gallerieImageManager = new GallerieImageManager($db);
	
	//TRAITEMENT AJOUT
	if(isset($_POST['url'])) {
		$gallerieImage = new GallerieImage(array('idProprietaire' => (int)$_GET['groupe'], 'urlImage' => $_POST['url']));
		$gallerieImageManager->add($gallerieImage);
	}



	// AFFICHAGE
	// Membres...
	$membresManager = new MembresManager($db);
	$membres = $membresManager->get((int)$_GET['groupe']);
	
	// Recupere les images
	$images = $gallerieImageManager->getAllFromUser((int)$_GET['groupe']);
	
	// Verifie la coherence de la page
	if($membres->id() == 0) {
		$errorMessage = 'Erreur, le groupe demande n\'existe pas';
	}
	
	if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && isset($_SESSION['type'])) {
		if($_SESSION['id'] == (int)$_GET['groupe'])
			$connecte = true;
	}
	else
		$connecte = false;
}

if($errorMessage == '') {
	PageImageVue::afficher($membres, $images, $connecte);
} else {
	Erreur::afficher($errorMessage);
}



?>
