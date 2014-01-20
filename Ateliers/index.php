<?php

// constantes
$nbPagesAffiche = 5;
$nbMembresParPage = 9;
$url = 'groupe.php?page=';

if(!isset($_SESSION)) {
	session_start();
}
$errorMessage = '';
	
// chargeur de classes
function chargerClasseMembre($className) {
	file_exists((dirname(dirname(__FILE__))).'/Membres/'.$className.'.class.php') &&
	require (dirname(dirname(__FILE__))).'/Membres/'.$className.'.class.php';
}
function chargerClasseAtelier($className) {
	file_exists((dirname(dirname(__FILE__))).'/Ateliers/'.$className.'.class.php') &&
	require (dirname(dirname(__FILE__))).'/Ateliers/'.$className.'.class.php';
}
spl_autoload_register('chargerClasseAtelier');
spl_autoload_register('chargerClasseMembre');


require ('../Erreur.class.php');

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
$nbBillets = $membresManager->countFromType(2);// les ateliers ont le type 2.
require_once('../Blog/PageGenerator.class.php');
$nbPages = PageGenerator::getNbPages((int)$nbBillets, $nbMembresParPage);
if($page < 1 || $page > $nbPages) { // verifie la veracite de la page courante
	$page = 1;
}
// Recuperation des billets
$membres = $membresManager->getListFromType(($page - 1) * $nbMembresParPage, $nbMembresParPage, 2);

// Vue
if($errorMessage == '') {
	IndexVue::afficher($membres, $nbPagesAffiche, $nbPages, $page, $url);
} else {
	Erreur::afficher($errorMessage);
}

?>
