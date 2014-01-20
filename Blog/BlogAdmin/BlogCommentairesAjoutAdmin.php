<?php

	$errorMessage = '';

	// chargeur de classes dossier supperieur
	function chargerClasseBlog($className) {
		file_exists (dirname(dirname(__FILE__)).'/'.$className.'.class.php') &&
		require (dirname(dirname(__FILE__)).'/'.$className.'.class.php');
	}
	// chargeur de classes du dossier
	function chargerClasseBlogAdmin($className) {
		file_exists (dirname(__FILE__)).'/'.($className.'.class.php') &&
		require dirname(__FILE__).'/'.($className.'.class.php');
	}
	spl_autoload_register('chargerClasseBlog');
	spl_autoload_register('chargerClasseBlogAdmin');

	if(isset($_GET['billet'])) {
		
		//Connection a la base de donnee
		include ((dirname(dirname(dirname(__FILE__)))).'/dbConnection.php');
		
		if(isset($_POST['contenu'])) {
			$commentaireManager = new CommentaireManager($db);
			$donnees = array(
				'auteur' => 'Campus en Musique',
				'id_billet' => $_GET['billet'],
				'commentaire' => $_POST['contenu']
			);
			$commentaire = new Commentaire($donnees);
			$commentaireManager->add($commentaire);
			
			header('Location: BlogCommentairesAdmin.php?billet='.$_GET['billet']);
		}
		
		?>
<a href='BlogCommentairesAdmin.php?billet=<?php echo $_GET['billet']; ?>'>Retourner aux commentaires</a>
<h1><?php echo $errorMessage; ?></h1>

<form action='BlogCommentairesAjoutAdmin.php?billet=<?php echo $_GET['billet']; ?>' method='post'>
	<label>Le pseudo est par defaut "Campus en Musique"</label><br/><br/>
	<label for='contenu'>Commentaire :</label><br/>
	<textArea id='contenu' name='contenu' style='width:99%;height:50%;' required><?php
		if(isset($_POST['contenu'])) {
			echo nl2br(htmlspecialchars($_POST['contenu']));
		}?></textArea><br/>
	<input type='submit' value='Ajouter'>
</form>
<?php
		
		
		
	} else {
		echo 'Aucun billet associe au commentaire';
	}

?>

