<?php
	$errorMessage = '';

	// chargeur de classes
	function chargerClasseBlog($className) {
		file_exists (dirname(dirname(__FILE__)).'/'.$className.'.class.php') &&
			require (dirname(dirname(__FILE__)).'/'.$className.'.class.php');
	}
	spl_autoload_register('chargerClasseBlog');

	if(isset($_POST['contenu']) && isset($_POST['titre'])) { // On a le commentaire a ajouter
		if(strlen($_POST['titre']) > 50) {
			$errorMessage = 'Le titre doit faire moins de 50 caracteres. Il en fait '.strlen($_POST['titre']);
		} else if ($_POST['contenu'] > 2048) {
			$errorMessage = 'Le contenu doit faire moins de 2048 caracteres. Il en fait '.strlen($_POST['contenu']);
		} else {
		// Mise en table des donnees
		$donnees = array(
			'auteur' => 'Campus en Musique',
			'titre' => $_POST['titre'],
			'contenu' => $_POST['contenu']
		);
		// creation de l'objet billet
		$billet = new Billet($donnees);
		
		//Connection a la base de donnee
		include ((dirname(dirname(dirname(__FILE__)))).'/dbConnection.php');
		
		// Creation du manager.
		$billetManager = new BilletManager($db);
		$billetManager->add($billet);
		
		header('Location: BlogBilletAdmin.php');
		}
	} // Fin le commentaire doit etre ajoute
	// maintenant, soit le WebMaster n'a rien remplit, soit il a fait une erreur.
	
?>
<a href='BlogBilletAdmin.php'>Revenir aux billets</a>
<h1><?php echo $errorMessage; ?></h1>

<form action='BlogBilletAjouterAdmin.php' method='post'>
	<label>Le pseudo est par defaut "Campus en Musique"</label><br/><br/>
	<label for='titre'>Titre :</label><br/>
	<input type='text' id='titre' name='titre' style='width:99%;' value='<?php 
		if(isset($_POST['titre'])) {
			echo nl2br(htmlspecialchars($_POST['titre']));
		}?>' required/><br/>
	<label for='contenu'>Commentaire :</label><br/>
	<textArea id='contenu' name='contenu' style='width:99%;height:50%;' required><?php
		if(isset($_POST['contenu'])) {
			echo br2nl(htmlspecialchars($_POST['contenu']));
		}?></textArea><br/>
	<input type='submit' value='Ajouter'>
</form>
<?php









?>
