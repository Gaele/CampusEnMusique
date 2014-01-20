<?php

// connection a la base de donnee
	try {
		$db = new PDO('mysql:host=localhost;dbname=miniblog', 'root', '');
	} catch (Exception $e) {
		die('erreur'.$e->getMessage());
	}

?>

