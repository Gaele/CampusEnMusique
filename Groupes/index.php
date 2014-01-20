<?php

// constantes
$nbPagesAffiche = 5;
$nbMembresParPage = 9;
$url = 'index.php?page=';

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

require ((dirname(dirname(__FILE__))).'/Erreur.class.php');

// Verifie l'integrite de la page
if(!isset($_GET['page']) || !is_numeric($_GET['page'])) {
	$page = 1;
} else {
	$page = (int)$_GET['page'];
}

//Connection a la base de donnee
include (dirname(dirname(__FILE__)).'/dbConnection.php');

// Groupes
$membresManager = new MembresManager($db);

// calcul le nombre de pages
$nbBillets = $membresManager->countFromType(1);// les groupes ont le type 1.
require_once('../Blog/PageGenerator.class.php');
$nbPages = PageGenerator::getNbPages((int)$nbBillets, $nbMembresParPage);
if($page < 1 || $page > $nbPages) { // verifie la veracite de la page courante
	$page = 1;
}
// Recuperation des billets
$membres = $membresManager->getListFromType(($page - 1) * $nbMembresParPage, $nbMembresParPage, 1);

// Vue
if($errorMessage == '') {
	IndexVue::afficher($membres, $nbPagesAffiche, $nbPages, $page, $url);
	//echo 'Affiche la vue';
} else {
	Erreur::afficher($errorMessage);
}

?>
