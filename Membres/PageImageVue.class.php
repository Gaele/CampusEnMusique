
<?php
class PageImageVue {

	public static function afficher(Membres $membre, array $images, $connecte) {

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
				<h1>Images <?php echo htmlspecialchars($membre->pseudo()); ?></h1>
				
				<h3><a href='../Groupes/pagePerso.php?groupe=<?php echo htmlspecialchars($membre->id()); ?>'>
				Retour à la Page <?php echo htmlspecialchars($membre->pseudo()); ?>
				</a></h3>
				
				<?php
					if($connecte) {
						
					
						echo ('<form action =\'pageImage.php?groupe='.$membre->id().'\' method=\'post\'>');
						echo '<fieldset>';
						echo '<legend>Ajouter une photo (12 maximum)</legend>';
						echo '<label><strong>url </label></strong>';
						echo '<input type=\'url\' name=\'url\' required/>';
						echo '<br/>';
						echo '<input type=\'submit\' value=\'Ajouter\'><br/>';
						
						echo '<em>';
						echo 'Pour ajouter une photo :<br/>';
						echo 'Déposez-la sur un site puis faites un clique droit sur l\'image. ';
						echo 'Choisissez l\'option \"Copier l\'url de l\'image\" ';
						echo 'Enfin, revenez sur cette page, faites un clique droit dans la zone url ci-dessus et choisissez \'coller\'';
						echo '</em>';
						
						echo '</fieldset>';
						echo '</form>';
						echo '<br/>';
						
						echo '<br/>';
						echo '<br/>';
					}
				?>
				<div class='galerieImage'>
						<?php
						if(empty($images)) {
							echo '<em>Galerie Vide</em>';
						} else {
						
							$cpt = 0;
							foreach($images as $key => $image) {
								if(($cpt%3) == 0)
									echo '<div class=\'cadrePetiteImage\'>';
							?>
								<!-- <span class='cadrePetiteImage'> -->
								<div class = 'petiteImage'>
									<em><?php echo htmlspecialchars($image->formatedDate()); ?></em>
									<a href="<?php echo htmlspecialchars($image->urlImage()); ?>">
										<img src='<?php echo htmlspecialchars($image->urlImage()); ?>' alt='Une image du groupe'>
									</a>
									<?php
									if($connecte) {
										echo '<a href=\'pageImageRemove.php?groupe='.$membre->id().'&image='.$image->id().'\'>Supprimer cette photo</a>';
									}
									?>
								</div>
								<!-- </span> -->
							<?php
								if(($cpt%3) == 2)
									echo '</div>';
							
								$cpt++;
							}
							if(($cpt%3) != 0)
									echo '</div>';
						}
						?>
				
			</div><!-- galerieImage -->
			
			
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

