<?php

class IndexVue {
	
	public static function afficher($errorMessage) {

	require dirname(dirname(__FILE__)).'/InclusionCampus.class.php';
	$inclusionCampus = new InclusionCampus(1);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Campus en musique</title>
		<?php $inclusionCampus->inclusionStyle(); ?>
	</head>
	
	<body>
		<div id="block_page">
		
			<?php $inclusionCampus->inclusionBanniere(); ?>
			
			<div id="corpsDeLaPage">
			
			<?php $inclusionCampus->inclusionMenuGauche(); ?>
			
			<div id="panneau_central">

	<h1>Connexion</h1>

	<?php
		if($errorMessage != '') {
			echo htmlspecialchars($errorMessage);
		}
	?>
	
	<script type="text/javascript">
	var RecaptchaOptions = {
		theme : 'clean'
	};
	</script>
	<form action = 'index.php' method='post'>
		<label for='pseudo'>pseudonyme</label><br/>
		<input type='text' name='pseudo' id='pseudo' value='<?php if(isset($_POST['pseudo'])) {echo trim(htmlspecialchars($_POST['pseudo']));} ?>' required/><br/>
		<label for='password'>mot de passe</label><br/>
		<input type='password' name='pass' id='password' required/><br/>
		<?php
			require_once(dirname(dirname(__FILE__)).'/reChapca/recaptchalib.php');
			$publickey = "6LeBwNUSAAAAAIDT05VCH_0G_qW0DOf4UllL_kIy"; // you got this from the signup page
			echo recaptcha_get_html($publickey);
		?>
		<input type='submit' value='Connexion'/>
	</form>
			</div>
			
			<?php $inclusionCampus->inclusionMenuDroit(); ?>
			
			</div>
			
			<?php $inclusionCampus->inclusionFooter(); ?>
			
		</div>
	</body>
</html>
<?php
	}
}

?>
