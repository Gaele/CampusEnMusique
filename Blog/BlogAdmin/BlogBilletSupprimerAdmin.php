<?php

	// chargeur de classes
	function chargerClasseBlog($className) {
		file_exists (dirname(dirname(__FILE__)).'/'.$className.'.class.php') &&
			require (dirname(dirname(__FILE__)).'/'.$className.'.class.php');
	}
	spl_autoload_register('chargerClasseBlog');


	if(isset($_GET['billet']) && is_numeric($_GET['billet'])) {
		
		//Connection a la base de donnee
		include ((dirname(dirname(dirname(__FILE__)))).'/dbConnection.php');
		
		$commentaireManager = new CommentaireManager($db);
		$commentaireManager->deleteWithBillet((int)$_GET['billet']);
		
		$billetManager = new BilletManager($db);
		$billetManager->delete((int)$_GET['billet']);
		
		header('Location: BlogBilletAdmin.php');
	} else {
	
		if(!isset($_GET['billet'])) {
			echo 'Erreur, le billet a supprimer n\'est pas transmis';
		} else if (!is_numeric($_GET['billet'])) {
			echo 'Erreur, le billet a supprimer n\'est pas un nombre';
		}


	}
	



?>

