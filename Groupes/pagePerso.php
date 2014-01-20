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

$connecte = false;

// Verifie l'integrite de la page
if(!isset($_GET['groupe']) || !is_numeric($_GET['groupe']) || $_GET['groupe'] < 0) {
	$errorMessage = 'Aucun groupe demandé';////////////////////////////////////Chercher une meilleur gestion...
} else {
	if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && isset($_SESSION['type'])) { // Verifie la connection
		if($_SESSION['id'] == (int)$_GET['groupe'])
			$connecte = true;
	}

	//Connection a la base de donnee
	include (dirname(dirname(__FILE__)).'/dbConnection.php');
	
	$membresManager = new MembresManager($db);
	$membres = $membresManager->get((int)$_GET['groupe']);
	
	if(isset($_GET['supprime']) && $connecte) {
		$_SESSION = array(); // Deconnection
		session_destroy();
		$membresManager->delete($membres);
		header('Location: ../index.php');
	}
	
	$pageGroupeManager = new PageGroupeManager($db);
	$page = $pageGroupeManager->get((int)$_GET['groupe']);
	
	$gallerieImageManager = new GallerieImageManager($db);
	$images = $gallerieImageManager->countUserImages((int)$_GET['groupe']);
	
	$gallerieVideoManager = new GallerieVideoManager($db);
	$videos = $gallerieVideoManager->countUserVideos((int)$_GET['groupe']);
	
	$gallerieSoundcloudManager = new GallerieSoundcloudManager($db);
	$soundclouds = $gallerieSoundcloudManager->countUserSoundclouds((int)$_GET['groupe']);
	
	// Verifie la coherence de la page
	if($membres->id() == 0) {
		$errorMessage = 'Erreur, le groupe demande n\'existe pas';
	} else if($page->idProprietaire() == 0) {
		$errorMessage = 'Erreur, la page groupe demande n\'existe pas';
	}
	
}

if($errorMessage == '') {
	PagePersoVue::affiche($membres, $page, $images, $videos, $connecte, $soundclouds);
} else {
	Erreur::afficher($errorMessage);
}



?>











