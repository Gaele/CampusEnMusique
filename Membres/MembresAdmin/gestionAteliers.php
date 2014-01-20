<?php

// chargeur de classes
function chargerClasseMembre($className) {
	file_exists((dirname(dirname(__FILE__))).'/'.$className.'.class.php') &&
	require (dirname(dirname(__FILE__))).'/'.$className.'.class.php';
}

spl_autoload_register('chargerClasseMembre');

include (dirname(dirname(dirname(__FILE__))).'/dbConnection.php'); // connection a la BD

$membresManager = new MembresManager($db);

if(isset($_POST['nom']) && isset($_POST['pw']) && isset($_POST['mail'])) {
	echo 'Atelier ajoute<br/>';
	$donnees = array('pseudo' => $_POST['nom'], 'pass' => $_POST['pw'], 'mail' => $_POST['pw'], 'type' => 2);
	$membre = new Membres($donnees);
	$membresManager->add($membre);
	
}


?>
<h1>Ajouter un Atelier</h1>
<form action='gestionAteliers.php' method='post'>
<fieldset>
	<label>Nom de l'atelier</label><br/>
	<input type='text' name='nom'/><br/>
	<label>Mot de passe</label><br/>
	<input type='text' name='pw'/><br/>
	<label>Mail</label><br/>
	<input type='text' name='mail'/><br/>
	<input type='submit' value='Ajouter'>
</fieldset>
</form>

<?php
echo '<h1>Cliquer sur un Atelier pour le supprimer</h1>';
if(isset($_GET['delete'])) {
	$membresManager->delete((int)$_GET['delete']);
}

// calcul du nombre a afficher
$nbAteliers = $membresManager->countFromType(2);// les ateliers ont le type 2.

$liste = $membresManager->getListFromType(0, (int)$nbAteliers, 2);

foreach($liste as $key => $groupe) {
	echo "<a href=gestionAteliers.php?delete=".$groupe->id().">".$groupe->pseudo()."</a></br>";
}


?>












