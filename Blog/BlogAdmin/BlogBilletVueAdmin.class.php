<?php

	// Affiche une page de blog contenant tous les sujets de discussion (billets)
	// Cette classe se concentre sur une certaine page d'un certain blog
	class BlogBilletVueAdmin {
	
		// Affiche la page des sujets (billets) du forum
		// $billets : un tableau contenant tous les billets de la page
		// $nbPagesAffiche : le nombre de pages qui seront accessible en un clic a gauche et a droite
		//		de la page courrante dans la numerotation des pages
		// $page : la page courante
		// $url : Un url incomplet pour les liens vers les autres pages du forum
		//		il suffit de lui rajouter le numero de la page a atteindre.
		public static function affiche($billets, $nbPagesAffiche, $nbPages, $page, $url) {
			
			//verification de l'integrite des donnees.
			if(!is_array($billets) || !is_numeric($page) || !is_string($url) || 
				!is_numeric($nbPagesAffiche) || !is_numeric($nbPages)) {
				echo 'Probleme';
				return;
			}
			
			require_once(dirname(dirname(dirname(__FILE__))).'/InclusionCampus.class.php');
			$inclusionCampus = new InclusionCampus(2);
		?>
<!DOCTYPE html>
<html>
	<head>
		<title>Forum</title>
		<!-- <meta charset="utf-8"/> -->
		<?php $inclusionCampus->inclusionStyle(); ?>
	</head>
	
	<body>
		<div id="block_page">
		
			<?php 
			
			$inclusionCampus->inclusionBanniere(); ?>
			
			<div id="corpsDeLaPage">
				
				<?php $inclusionCampus->inclusionMenuGauche(); ?>
			
			<div id="panneau_central">
			<h1>Forum</h1>
			<a href='BlogBilletAjouterAdmin.php'>Ajouter un Billet</a>
			
			
			<?php
			require_once (dirname(__FILE__).'/VueBlogAdmin.class.php');
			foreach($billets as $key => $billet) {
				VueBlogAdmin::afficheBillet($billet, true);
				
			}
			//require 'PageGenerator.class.php';
			PageGenerator::echoLiensVersPagesSuivantes($nbPagesAffiche, $nbPages, $page, $url);
			?>
			
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
