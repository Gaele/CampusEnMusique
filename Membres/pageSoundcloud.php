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
	$errorMessage = 'Aucun groupe demandé';////////////////////////////////////Chercher une meilleure gestion...
} else {
	//Connection a la base de donnee
	include (dirname(dirname(__FILE__)).'/dbConnection.php');

	// Manager d'images
	$gallerieSoundcloudManager = new GallerieSoundcloudManager($db);
	
	//TRAITEMENT AJOUT
	if(isset($_POST['balise'])) {
		if(!(strpos($_POST['balise'], 'https://w.soundcloud.com/player/') === false)){ // si c'est un lien Soundcloud
			$gallerieSoundcloud = new GallerieSoundcloud(array('idProprietaire' => (int)$_GET['groupe'], 'urlSoundcloud' => $_POST['balise']));
			$gallerieSoundcloudManager->add($gallerieSoundcloud);
		} else {
			$errorMessage = "URL incorrect. Seuls les url Soundcloud sont acceptes.";// traitement d'erreur
		}
	}
	

	// AFFICHAGE
	// Membres...
	$membresManager = new MembresManager($db);
	$membres = $membresManager->get((int)$_GET['groupe']);
	
	// Recupere les images
	$soundclouds = $gallerieSoundcloudManager->getAllFromUser((int)$_GET['groupe']);
	
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
	pageSoundcloudVue::afficher($membres, $soundclouds, $connecte);
} else {
	Erreur::afficher($errorMessage);
}



?>
