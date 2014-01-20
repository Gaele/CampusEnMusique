<?php



// chargeur de classes
function chargerClasseMembre($className) {
	file_exists((dirname(dirname(__FILE__))).'/'.$className.'.class.php') &&
	require (dirname(dirname(__FILE__))).'/'.$className.'.class.php';
}

spl_autoload_register('chargerClasseMembre');

include (dirname(dirname(dirname(__FILE__))).'/dbConnection.php'); // connection a la BD

$membresManager = new MembresManager($db);


echo '<h1>Cliquer sur un membre pour le supprimer</h1>';
if(isset($_GET['delete'])) {
	$membresManager->delete((int)$_GET['delete']);
}

// calcul du nombre a afficher
$nbGroupes = $membresManager->countFromType(1);// les groupes ont le type 1.

$liste = $membresManager->getListFromType(0, (int)$nbGroupes, 1);

foreach($liste as $key => $groupe) {
	echo "<a href=gestionGroupes.php?delete=".$groupe->id().">".$groupe->pseudo()."</a></br>";
}


?>












