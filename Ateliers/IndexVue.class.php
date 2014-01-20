<?php

	// Affiche une page de blog contenant tous les sujets de discussion (membres)
	// Cette classe se concentre sur une certaine page d'un certain blog
	class IndexVue {
	
		// Affiche la page des sujets (membres) du forum
		// $membres : un tableau contenant tous les membres de la page
		// $nbPagesAffiche : le nombre de pages qui seront accessible en un clic a gauche et a droite
		//	de la page courrante dans la numerotation des pages
		// $page : la page courante
		// $url : Un url incomplet pour les liens vers les autres pages du forum
		//		il suffit de lui rajouter le numero de la page a atteindre.
		public static function afficher($membres, $nbPagesAffiche, $nbPages, $page, $url) {
			
			//verification de l'integrite des donnees.
			if(!is_array($membres) || !is_numeric($page) || !is_string($url) || 
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
		<title>Ateliers</title>
		<?php $inclusionCampus->inclusionStyle(); ?>
	</head>
	
	<body>
		<div id="block_page">
		
			<?php $inclusionCampus->inclusionBanniere(); ?>
			
			<div id="corpsDeLaPage">
				
				<?php $inclusionCampus->inclusionMenuGauche(); ?>
			
			<div id="panneau_central">
			<h1>Ateliers</h1>
			<br/><br/>
			<?php
			if(empty($membres)) {
				echo '<em>Aucun groupe n\'est inscrit pour le moment</em>';
			} else {
				//Connection a la base de donnee
				include (dirname(dirname(__FILE__)).'/dbConnection.php');
						
				$cpt = 0;// Compteur pour l'affichage
				echo '<div class=\'galerieImage\'>';
				foreach($membres as $key => $membre) {
					
						//Cherche page
						$pageGroupeManager = new PageGroupeManager($db);
						$page = $pageGroupeManager->get($membre->id());//recupere la page
					
						if(($cpt%3) == 0)
							echo '<div class=\'cadrePetiteImage\'>';
							
						if(trim(htmlspecialchars($page->imagePresentation())) != '')
							$src = htmlspecialchars($page->imagePresentation());
						else
							$src = '../Images/Membres/defaultImage.png';	
						
					?>
						<div class = 'petiteImage'>
							<h3><?php echo htmlspecialchars($membre->pseudo()); ?></h3>
							<a href='../Groupes/pagePerso.php?groupe=<?php echo $membre->id(); ?>'><img src='<?php echo $src; ?>' alt='Un groupe' /></a>
							
						</div>
<?php
						if(($cpt%3) == 2) {
							echo '</div>';// cadre petite image
							echo '<br/>';
						}
						$cpt++;
				}
				if(($cpt%3) != 0)
					echo '</div>';// cadre petite image
				
				echo '</div>';// galerieImage
				
			}
			require_once('../Blog/PageGenerator.class.php');
			PageGenerator::echoLiensVersPagesSuivantes($nbPagesAffiche, $nbPages, $page, $url);
			?>
			</div><!-- Panneau central -->
				<?php $inclusionCampus->inclusionMenuDroit(); ?>
				
			</div><!-- Corps de la page -->
			
			<?php $inclusionCampus->inclusionFooter(); ?>
			
		</div><!-- Block page -->
	</body>
</html>
		<?php
		}
	}
?>




