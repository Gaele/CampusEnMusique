<?php
if(!isset($_SESSION)) {
	session_start();
}
$errorMessage = '';
$petiteErreur = '';

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
	$errorMessage = 'Aucun groupe demandé';////////////////////////////////////Chercher une meilleur gestion...
} else {
	// Verifie que l'utilisateur est bien connecte a se compte
	if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && isset($_SESSION['type'])) {
			if($_SESSION['id'] == (int)$_GET['groupe'])
				
				//Connection a la base de donnee
				include (dirname(dirname(__FILE__)).'/dbConnection.php');
				
				$membresManager = new MembresManager($db);
				$membres = $membresManager->get((int)$_GET['groupe']);
				
				$pageGroupeManager = new PageGroupeManager($db);
				$page = $pageGroupeManager->get((int)$_GET['groupe']);
				
				// Verifie la coherence de la page
				if($membres->id() == 0) {
					$errorMessage = 'Erreur, le groupe demande n\'existe pas';
				} else if($page->idProprietaire() == 0) {
					$errorMessage = 'Erreur, la page groupe demande n\'existe pas';
				}
				
		}
		else {
			$errorMessage = 'Impossible de modifier une page qui n\'est pas la votre';
	}
}

$donnees = array();
// Si on a remplit le formulaire, on regarde ce qui est present
$fomulaireRemplit = false;
if(isset($_POST['description']) || isset($_POST['projets']) || isset($_POST['email']) || isset($_POST['url']) || isset($_POST['tel']) || isset($_POST['image'])){
	if(strlen($_POST['description']) > 1024) {
		$petiteErreur = 'La description ne doit pas depasser 1024 caracteres. (elle en fait '.strlen($_POST['description']).')';
	} if(strlen($_POST['projets']) > 1024) {
		$petiteErreur = 'Le paragraphe projets ne doit pas depasser 1024 caracteres. (il en fait '.strlen($_POST['projets']).')';
	} if(strlen($_POST['email']) > 255) {
		$petiteErreur = 'Le paragraphe projets ne doit pas depasser 255 caracteres. (il en fait '.strlen($_POST['email']).')';
	} if(strlen($_POST['url']) > 255) {
		$petiteErreur = 'L\'adresse du site ne doit pas depasser 255 caracteres. (il en fait '.strlen($_POST['url']).')';
	} if(strlen($_POST['tel']) > 255) {
		$petiteErreur = 'le numero de telephone ne doit pas depasser 255 caracteres. (il en fait '.strlen($_POST['tel']).')';
	}if(strlen($_POST['image']) > 255) {
		$petiteErreur = 'l\'url de l\'image ne doit pas depasser 255 caracteres. (il en fait '.strlen($_POST['image']).')';
	} else {
		$donnees['historique'] = (trim($_POST['description']) == '')?' ':$_POST['description'];
		$donnees['projets'] = (trim($_POST['projets']) == '')?' ':$_POST['projets'];
		$donnees['mail'] = (trim($_POST['email']) == '')?' ':$_POST['email'];
		$donnees['site'] = (trim($_POST['url']) == '')?' ':$_POST['url'];
		$donnees['telephone'] = (trim($_POST['tel']) == '')?' ':$_POST['tel'];
		$donnees['imagePresentation'] = (trim($_POST['image']) == '')?' ':$_POST['image'];
		
		// Creation de la nouvelle page
		$donnees['idProprietaire'] = (int)$_GET['groupe'];
		$newPage = new PageGroupe($donnees);
		
		//Il faut traiter les cas null manuellement
		//$newPage = new PageGroupe(array('idProprietaire' => (int)$_GET['groupe']));
		// $newPage->setHistorique($_POST['description']);
		// $newPage->setProjets($_POST['projets']);
		// $newPage->setMail($_POST['email']);
		// $newPage->setSite($_POST['url']);
		//$newPage->setTelephone($_POST['tel']);
		//$newPage->setTelephone('');
		
		//Connection a la base de donnee
		include (dirname(dirname(__FILE__)).'/dbConnection.php');

		$pageGroupeManager = new PageGroupeManager($db);
		$pageGroupeManager->update($newPage);
		
		header('Location: pagePerso.php?groupe='.$_GET['groupe']);
	}
}

// echo 'id : <br/>';
// echo $newPage->idProprietaire();
// echo 'Image presentation : <br/>';
// echo $newPage->imagePresentation();
// echo 'historique : <br/>';
// echo $newPage->historique();
// echo 'projets : <br/>';
// echo $newPage->projets();
// echo 'mail : <br/>';
// echo $newPage->mail();
// echo 'site : <br/>';
// echo $newPage->site();
// echo 'telephone : <br/>';
// echo $newPage->telephone();
	
if($errorMessage == '') {
	PageGroupeModificationVue::afficher($membres, $page, $petiteErreur);
} else {
	Erreur::afficher($errorMessage);
}

?>
