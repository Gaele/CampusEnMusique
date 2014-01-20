<?php


class Erreur {

	public static function afficher($errorMessage) {

	require_once 'InclusionCampus.class.php';
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
				<h1>Erreur</h1>
				<div class="erreur">
					<strong><?php echo $errorMessage; ?></strong>
				</div>
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

