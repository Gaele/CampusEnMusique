<?php

class CommentaireAjoutVue {

	public function afficher($errorMessage) {
	
	

	require_once(dirname(dirname(__FILE__)).'/InclusionCampus.class.php');
	$inclusionCampus = new InclusionCampus(1);
?>

<!DOCTYPE html>
<html>
	<header>
		<title>Ajout de Commentaires</title>
		<?php $inclusionCampus->inclusionStyle(); ?>
		
	</header>

	<body>
		<div id="block_page">
		
			<?php 
			
			$inclusionCampus->inclusionBanniere(); ?>
			
			<div id="corpsDeLaPage">
				<?php $inclusionCampus->inclusionMenuGauche(); ?>
			
			<div id="panneau_central">
				<h1>Ajouter un commentaire</h1>
				<a href='BlogCommentaires.php?billet=<?php echo $_GET['billet']; ?>'>Retourner aux commentaires</a>
				
				<?php if($errorMessage != '') {?>
				<br/>
				<div class='erreur'>Une erreur est survenue :<br/>
				<strong><?php echo $errorMessage;?></strong><br/>
				Veuillez reessayer
				</div>
				<?php }?>
				
				<script type="text/javascript">
				var RecaptchaOptions = {
					theme : 'clean'
				};
				</script>
				<form action='CommentairesAjout.php?billet=<?php echo $_GET['billet']; ?>' method='post'>
					<label id='pseudo'>Pseudo</label> <br/>
					<input type='text' name='pseudo' for='pseudo' value='<?php if(isset($_POST['pseudo'])) {
							echo nl2br(htmlspecialchars($_POST['pseudo']));
						} ?>' required/> <br/>
					<label id='lien'>Lien photo ou video</label> <br/>
					<input type='text' name='lien' for='lien' value='<?php if(isset($_POST['lien'])) {
							echo nl2br(htmlspecialchars($_POST['lien']));
						} ?>' style="width:90%;" /> <br/>
					<label id='message'>Message</label> <br/>
					<textArea name='message' rows='8' cols='45' for='message' required><?php if(isset($_POST['message'])) {
							echo nl2br(htmlspecialchars($_POST['message']));
						} ?></textArea> <br/>
					
					
					<?php
						require_once(dirname(dirname(__FILE__)).'/reChapca/recaptchalib.php');
						$publickey = "6LeBwNUSAAAAAIDT05VCH_0G_qW0DOf4UllL_kIy"; // you got this from the signup page
						echo recaptcha_get_html($publickey);
					?>
					<input type='submit' value='Envoyer'/>
				</form>
				
			</div>
			
				<?php $inclusionCampus->inclusionMenuDroit(); ?>
				
			</div>
			
			<?php $inclusionCampus->inclusionFooter(); ?>
			
		</div>
		
	</body>
</html>
	
	
	
	
	
<?php
	echo 'Affiche fin page';
	}

}


?>