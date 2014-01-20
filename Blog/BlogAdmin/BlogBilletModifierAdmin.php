<?php

	$errorMessage = '';
	
	// chargeur de classes
	function chargerClasseBlog($className) {
		file_exists (dirname(dirname(__FILE__)).'/'.$className.'.class.php') &&
			require (dirname(dirname(__FILE__)).'/'.$className.'.class.php');
	}
	spl_autoload_register('chargerClasseBlog');
	
	if(isset($_GET['billet'])) {
		if(!is_numeric($_GET['billet'])) {
			echo 'Un id de billet negatif est impossible';
		} else if ($_GET['billet'] < 1) {
			echo 'Un id <= 0 est impossible';
		} else { // On peut traiter l'info, elle a ete verifie
			
			//Connection a la base de donnee
			include ((dirname(dirname(dirname(__FILE__)))).'/dbConnection.php');
	
			$billetManager = new BilletManager($db);
			
			if(isset($_POST['contenu']) || isset($_POST['titre'])) {// le formulaire est remplit
				if(strlen($_POST['titre']) > 50) {
					$errorMessage = 'Le titre doit faire moins de 50 caracteres. Il en fait '.strlen($_POST['titre']);
				} else if ($_POST['contenu'] > 2048) {
					$errorMessage = 'Le contenu doit faire moins de 2048 caracteres. Il en fait '.strlen($_POST['contenu']);
				} else {
				
				$donnees = array(
					'titre' => (string)$_POST['titre'],
					'contenu' => (string)$_POST['contenu'],
					'id' => (int)$_GET['billet']
				);
				$billet = new Billet($donnees);
				
				$billetManager->update($billet);
				
				header('Location: BlogBilletAdmin.php');
				}
			}// On affiche le formulaire
				$billet = $billetManager->get((int)$_GET['billet']);
			?>
<a href='BlogBilletAdmin.php'>Revenir aux billets</a>
<h1><?php echo $errorMessage; ?></h1>

<form action='BlogBilletModifierAdmin.php?billet=<?php echo $_GET['billet']; ?>' method='post'>
	<label for='titre'>Titre :</label><br/>
	<input type='text' id='titre' name='titre' style='width:99%;' value='<?php echo nl2br(htmlspecialchars($billet->titre())); ?>' required/><br/>
	<label for='contenu'>Commentaire :</label><br/>
	<textArea id='contenu' name='contenu' style='width:99%;height:50%;' required><?php echo nl2br(htmlspecialchars($billet->contenu())); ?></textArea><br/>
	<input type='submit' value='Modifier'>
</form>
			<?php
		}// fin traitement de l'info verifie
	}

?>

