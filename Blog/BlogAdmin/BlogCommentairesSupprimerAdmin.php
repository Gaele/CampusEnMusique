<?php

	// chargeur de classes dossier supperieur
	function chargerClasseBlog($className) {
		file_exists (dirname(dirname(__FILE__)).'/'.$className.'.class.php') &&
		require (dirname(dirname(__FILE__)).'/'.$className.'.class.php');
	}
	// chargeur de classes du dossier
	function chargerClasseBlogAdmin($className) {
		file_exists (dirname(__FILE__)).'/'.($className.'.class.php') &&
		require dirname(__FILE__).'/'.($className.'.class.php');
	}
	spl_autoload_register('chargerClasseBlog');
	spl_autoload_register('chargerClasseBlogAdmin');

	$billet = $_GET['billet'];
	$id = $_GET['id'];
	
	if(isset($billet) && is_numeric($billet) && isset($id) && is_numeric($id)) {
		
		//Connection a la base de donnee
		include ((dirname(dirname(dirname(__FILE__)))).'/dbConnection.php');
	
		$commentaireManager = new CommentaireManager($db);
		$commentaireManager->delete((int)$id);
		
		header('Location: BlogCommentairesAdmin.php?billet='.$billet);
	
	} else {
		echo 'Aucun billet associe au commentaire';
	}


?>

