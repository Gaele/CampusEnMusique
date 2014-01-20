<?php

if(!isset($_SESSION)) {
	session_start();
}

// chargeur de classes
function chargerClasseMembre($className) {
	file_exists((dirname(dirname(__FILE__))).'/Membres/'.$className.'.class.php') &&
	require (dirname(dirname(__FILE__))).'/Membres/'.$className.'.class.php';
}

spl_autoload_register('chargerClasseMembre');

if(isset($_GET['soundcloud']) && is_numeric($_GET['soundcloud']) && isset($_GET['groupe']) && is_numeric($_GET['groupe'])){
	
	// Verifie la connection
	if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && isset($_SESSION['type'])) {
		if($_SESSION['id'] == (int)$_GET['groupe']) {
			//Connection a la base de donnee
			include (dirname(dirname(__FILE__)).'/dbConnection.php');
			
			$gallerieSoundcloudManager = new GallerieSoundcloudManager($db);
			$gallerieSoundcloudManager->delete((int)$_GET['soundcloud']);
		}
	}
	header('Location: pageSoundcloud.php?groupe='.((int)$_GET['groupe']));
}

?>