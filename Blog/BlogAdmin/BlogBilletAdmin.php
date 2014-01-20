<?php
	// constantes
	$nbPagesAffiche = 5;
	$nbBilletsParPage = 10;
	$url = 'BlogBilletAdmin.php?page=';
	
	// chargeur de classes
	function chargerClasseBlog($className) {
		file_exists (dirname(dirname(__FILE__)).'/'.$className.'.class.php') &&
			require (dirname(dirname(__FILE__)).'/'.$className.'.class.php');
	}
	// chargeur de classes
	function chargerClasseBlogAdmin($className) {
			file_exists (dirname(__FILE__)).'/'.($className.'.class.php') &&
			require dirname(__FILE__).'/'.($className.'.class.php');
	}
	spl_autoload_register('chargerClasseBlog');
	spl_autoload_register('chargerClasseBlogAdmin');
	
	
	function __autoload($className) {
		
	}
	
	// Verifie l'integrite de la page
	if(!isset($_GET['page']) || !is_numeric($_GET['page'])) {
		$page = 1;
	} else {
		$page = (int)$_GET['page'];
	}
	
	//Connection a la base de donnee
	include ((dirname(dirname(dirname(__FILE__)))).'/dbConnection.php');
	
	$billetManager = new BilletManager($db);
//	$billet = new Billet(array('id' => 14, 'contenu' => 'Contenu dynamique', 'auteur' => 'le grand createur...'));
//	$billetManager->add($billet);
//	$billetManager->delete(15);
//	$billetManager->update($billet);

	// calcul le nombre de pages
	$nbBillets = $billetManager->count();
	$nbPages = PageGenerator::getNbPages((int)$nbBillets, $nbBilletsParPage);
	if($page < 1 || $page > $nbPages) { // verifie la veracite de la page courante
		$page = 1;
	}
	// Recuperation des billets
	$billets = $billetManager->getList(($page - 1) * $nbBilletsParPage, $nbBilletsParPage);
	
	// Vue
	BlogBilletVueAdmin::affiche($billets, $nbPagesAffiche, $nbPages, $page, $url);
	
	//PageGenerator::echoLiensVersPagesSuivantes($nbPagesAffiche, $nbPages, $page, $url);
	
	
?>