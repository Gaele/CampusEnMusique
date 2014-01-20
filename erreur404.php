<?php
	require 'InclusionCampus.class.php';
	$inclusionCampus = new InclusionCampus(0);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Campus en musique</title>
		<link rel="stylesheet" href="style2.css" />
	</head>
	
	<body>
		<div id="block_page">
		
			<?php $inclusionCampus->inclusionBanniere(); ?>
			
			<div id="corpsDeLaPage">
			
			<?php $inclusionCampus->inclusionMenuGauche(); ?>
			
			<div id="panneau_central">
				<h1>Erreur</h1>
				<div class="centrer">
					Ce site est encore en developpement et cette section est vide pour le moment.<br/>
					Pour toute question, veuillez nous contacter par ce lien : <a href="mailto:campusenmusic@gmail.com" target="_blank">campusenmusic@gmail.com</a>
				</div>
			</div>
			
			<?php $inclusionCampus->inclusionMenuDroit(); ?>
			
			</div>
			
			<?php $inclusionCampus->inclusionFooter(); ?>
			
		</div>
	</body>
</html>