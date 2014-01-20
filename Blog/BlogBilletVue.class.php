<?php

	// Affiche une page de blog contenant tous les sujets de discussion (billets)
	// Cette classe se concentre sur une certaine page d'un certain blog
	class BlogBilletVue {
	
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
				echo 'Gros probleme';
				return;
			}
			
			require_once(dirname(dirname(__FILE__)).'/InclusionCampus.class.php');
			$inclusionCampus = new InclusionCampus(1);
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
		
			<?php $inclusionCampus->inclusionBanniere(); ?>
			
			<div id="corpsDeLaPage">
				
				<?php $inclusionCampus->inclusionMenuGauche(); ?>
			
			<div id="panneau_central">
			<h1>Forum</h1>
			<em>NOTE : le dernier billet n'a pas de sujet, il est dédié aux discussions libres.</em>
			<br/><br/>
			<?php
			
			foreach($billets as $key => $billet) {
				VueBlog::afficheBillet($billet, true);
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
