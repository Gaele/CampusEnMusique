
<?php
class PageVideoVue {

	public static function afficher(Membres $membre, array $videos, $connecte) {

		if(!isset($_SESSION)) {
			session_start();
		}
		
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
				<h1>Videos <?php echo htmlspecialchars($membre->pseudo()); ?></h1>
				
				<h3><a href='../Groupes/pagePerso.php?groupe=<?php echo htmlspecialchars($membre->id()); ?>'>
				Retour à la Page <?php echo htmlspecialchars($membre->pseudo()); ?>
				</a></h3>
				
				<?php
					if($connecte) {
						
						echo ('<form action =\'pageVideo.php?groupe='.$membre->id().'\' method=\'post\'>');
						echo '<fieldset>';
						echo '<legend>Ajouter une video (12 maximum)</legend>';
						echo '<label><strong>url </label></strong>';
						echo '<input type=\'url\' name=\'url\' required/>';
						echo '<br/>';
						echo '<input type=\'submit\' value=\'Ajouter\'><br/>';
						
						echo '<em>';
						echo 'Pour ajouter une video :<br/>';
						echo 'Déposez-la sur youtube. ';
						echo 'Copier l\'url de la page.';
						echo 'Enfin, revenez sur cette page, faites un clique droit dans la zone url ci-dessus et choisissez \'coller\'';
						echo '</em>';
						
						echo '</fieldset>';
						echo '</form>';
						echo '<br/>';
						
						echo '<br/>';
						echo '<br/>';
					}
				?>
				<div class='galerieVideo'>
						<?php
						if(empty($videos)) {
							echo '<em>Galerie Video</em>';
						} else {
							$cpt = 0;
							foreach($videos as $key => $video) {
								if(($cpt%2) == 0)
									echo '<div>';
							?>
								<div class='petiteVideo'>
									<em><?php echo htmlspecialchars($video->formatedDate()); ?></em></br>
									<iframe width="62%" height="315" src="<?php echo htmlspecialchars($video->urlVideo()); ?>" frameborder="0" allowfullscreen></iframe>
									<?php
									if($connecte) {
										echo '<a href=\'pageVideoRemove.php?groupe='.$membre->id().'&video='.$video->id().'\'>Supprimer cette video</a>';
									}
									?>
								</div>
							<?php
								if(($cpt%2) == 1)
									echo '</div>';
							
								$cpt++;
							}
							if(($cpt%2) != 0)
									echo '</div>';
						}
						?>
				
			</div><!-- galerievideo -->
			
			
			</div><!-- paneau central-->
			<?php $inclusionCampus->inclusionMenuDroit(); ?>
			
			</div><!-- corps page-->
			<?php $inclusionCampus->inclusionFooter(); ?>
		</div><!-- block page-->
	</body>
</html>

<?php

	}
}

