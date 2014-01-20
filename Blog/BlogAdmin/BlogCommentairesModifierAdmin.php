<?php

	$errorMessage = '';

	// chargeur de classes dossier supperieur
	function chargerClasseBlog($className) {
		file_exists (dirname(dirname(__FILE__)).'/'.$className.'.class.php') &&
		require (dirname(dirname(__FILE__)).'/'.$className.'.class.php');
	}
	
	spl_autoload_register('chargerClasseBlog');

	if(isset($_GET['billet']) && is_numeric($_GET['billet']) && $_GET['billet'] > 0
	&& isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
		
		//Connection a la base de donnee
		include ((dirname(dirname(dirname(__FILE__)))).'/dbConnection.php');
		
		$commentaireManager = new CommentaireManager($db);
		
		if(isset($_POST['contenu'])) {
			if(strlen($_POST['contenu']) > 2048) {
				$errorMessage = 'Le contenu ne doit pas depasser 2048 caracteres. Il en mesure '.strlen($_POST['contenu']);
			} else {
			
				$donnees = array(
					'commentaire' => (string)$_POST['contenu'],
					'id' => (int)$_GET['id']
				);
				$commentaire = new Commentaire($donnees);
				$commentaireManager->update($commentaire);
				
				header('Location: BlogCommentairesAdmin.php?billet='.$_GET['billet']);
			}
		}
		$commentaire = $commentaireManager->get((int)$_GET['id']);
		
		?>
<a href='BlogCommentairesAdmin.php?billet=<?php echo $_GET['billet']; ?>'>Retourner aux commentaires</a>
<h1><?php echo $errorMessage; ?></h1>

<form action='BlogCommentairesModifierAdmin.php?billet=<?php echo $_GET['billet']; ?>&id=<?php echo $_GET['id'] ?>' method='post'>
	<label>Le pseudo n'est pas changeable</label><br/><br/>
	<label for='contenu'>Commentaire :</label><br/>
	<textArea id='contenu' name='contenu' style='width:99%;height:50%;' required><?php
			echo nl2br(htmlspecialchars($commentaire->commentaire()));
	?></textArea><br/>
	<input type='submit' value='Modifier'>
</form>
<?php
		
		
		
	} else {
		echo 'Aucun billet associe au commentaire';
	}

?>