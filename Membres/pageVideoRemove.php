﻿<?php

if(!isset($_SESSION)) {
	session_start();
}

// chargeur de classes
function chargerClasseMembre($className) {
	file_exists((dirname(dirname(__FILE__))).'/Membres/'.$className.'.class.php') &&
	require (dirname(dirname(__FILE__))).'/Membres/'.$className.'.class.php';
}

spl_autoload_register('chargerClasseMembre');

if(isset($_GET['video']) && is_numeric($_GET['video']) && isset($_GET['groupe']) && is_numeric($_GET['groupe'])){
	
	// Verifie la connection
	if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && isset($_SESSION['type'])) {
		if($_SESSION['id'] == (int)$_GET['groupe']) {
			//Connection a la base de donnee
			include (dirname(dirname(__FILE__)).'/dbConnection.php');
			
			$gallerieVideoManager = new GallerieVideoManager($db);
			$gallerieVideoManager->delete((int)$_GET['video']);
		}
	}
	header('Location: pageVideo.php?groupe='.((int)$_GET['groupe']));
}

?>
