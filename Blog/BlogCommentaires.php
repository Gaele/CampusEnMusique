<?php
	// parametres : billet : indique le numero du billet
	// page : indique le numero de la page ou nous sommes.
	
	// Constantes
	$nbPagesAffiche = 2; // l'utilisateur a toujours acces $nbPagesAffiche precedentes et $nbPagesAffiche suivantes
	$nbCommentairesParPage = 10;
	// $url : l'url des autres pages du blog auquel il manque leur numero
	// Cet url est construit par la suite.
	$url = 'BlogCommentaires.php';
	
	// chargeur de classe
	function chargerClasse($className) {
		require $className.'.class.php';
	}
	spl_autoload_register('chargerClasse');
	
	// Verifie que la page est un nombre
	if(!isset($_GET['page']) || !is_numeric($_GET['page'])) {
		$page = 1;
	} else {
		$page = (int)$_GET['page'];
	}
	
	//Connection a la base de donnee
	include (dirname(dirname(__FILE__)).'/dbConnection.php');
	
	// Tente de recuperer le billet associe
	if(!isset($_GET['billet']) || !is_numeric($_GET['billet'])) {
		trigger_error('Erreur, aucun sujet associe au commentaire', E_USER_WARNING);
	} else {// on a un billet
		// Recuperation du sujet
		$billetManager = new BilletManager($db);
		$billet = $billetManager->get((int)$_GET['billet']);
		//  || $billet->id() == null
		if ($billet == null || $billet->id() == 0 ) { // Si le billet n'est pas dans la base
			//trigger_error('Erreur : le billet associe au commentaire n\'existe pas', E_USER_WARNING);
			require_once(dirname(dirname(__FILE__)).'/Erreur.class.php');
			Erreur::afficher('Erreur : le billet associe au commentaire n\'existe pas');
		} else {// le billet est dans la bd
			$url .= '?billet='.$billet->id().'&page=';
		
			//Chargement des commentaires
			$commentaireManager = new CommentaireManager($db);
			// calcul du nombre de pages de commentaires
			$nbCommentaires = $commentaireManager->count((int)$billet->id());
			$nbPages = PageGenerator::getNbPages((int)$nbCommentaires, $nbCommentairesParPage);
			if($page < 1 || $page > $nbPages) { // verifie la veracite des donnees
				$pages = 1;
			}
			// Recuperation des commentaires
			$commentaires = $commentaireManager->getList((int)$_GET['billet'], (int)(($page - 1) * $nbCommentairesParPage), $nbCommentairesParPage);

		BlogCommentairesVue::affiche($billet, $commentaires, $nbPagesAffiche, $nbPages, $page, $url);
	
		}// fin else le billet est dans la bd
		
	}// fin else on a un billet
	
?>


