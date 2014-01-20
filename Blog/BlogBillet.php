<?php
	// constantes
	$nbPagesAffiche = 5;
	$nbBilletsParPage = 10;
	$url = 'BlogBillet.php?page=';
	
	// chargeur de classes
	function chargerClasse($className) {
		require $className.'.class.php';
	}
	spl_autoload_register('chargerClasse');

	// Verifie l'integrite de la page
	if(!isset($_GET['page']) || !is_numeric($_GET['page'])) {
		$page = 1;
	} else {
		$page = (int)$_GET['page'];
	}
	
	//Connection a la base de donnee
	include (dirname(dirname(__FILE__)).'/dbConnection.php');
	
	$billetManager = new BilletManager($db);

	// calcul le nombre de pages
	$nbBillets = $billetManager->count();
	$nbPages = PageGenerator::getNbPages((int)$nbBillets, $nbBilletsParPage);
	if($page < 1 || $page > $nbPages) { // verifie la veracite de la page courante
		$page = 1;
	}
	// Recuperation des billets
	$billets = $billetManager->getList(($page - 1) * $nbBilletsParPage, $nbBilletsParPage);
	
	// Vue
	BlogBilletVue::affiche($billets, $nbPagesAffiche, $nbPages, $page, $url);
	
	//PageGenerator::echoLiensVersPagesSuivantes($nbPagesAffiche, $nbPages, $page, $url);
	
	
?>