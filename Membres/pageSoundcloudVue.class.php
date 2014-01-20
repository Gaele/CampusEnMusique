
<?php
class PageSoundcloudVue {

	public static function afficher(Membres $membre, array $soundclouds, $connecte) {

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
						
						echo ('<form action =\'pageSoundcloud.php?groupe='.$membre->id().'\' method=\'post\'>');
						echo '<fieldset>';
						echo '<legend>Ajouter une video (12 maximum)</legend>';
						echo '<label><strong>url </label></strong>';
						echo '<input type=\'balise\' name=\'balise\' required/>';
						echo '<br/>';
						echo '<input type=\'submit\' value=\'Ajouter\'><br/>';
						
						echo '<em>';
						echo 'Pour ajouter un lecteur Soundcloud :<br/>';
						echo 'Allez sur le site soundcloud.com et choissisez la musique que vous voulez mettre en ligne. ';
						echo 'Puis cliquer sur \' Share\' (en dessous le lecteur Soundcloud) et copier le code situe sous \' Embed Code \'. ';
						echo 'Enfin, revenez sur cette page, faites un clique droit dans la zone url ci-dessus et choisissez \'coller\'.';
						echo '</em>';
						
						echo '</fieldset>';
						echo '</form>';
						echo '<br/>';
						
						echo '<br/>';
						echo '<br/>';
					}
				?>
				<div>
						<?php
						if(empty($soundclouds)) {
							echo '<em>Galerie Soundcloud</em>';
						} else {
							$cpt = 0;
							foreach($soundclouds as $key => $soundcloud) {
								if(($cpt%2) == 0)
									echo '<div>';
							?>
								<div>
									<em><?php echo htmlspecialchars($soundcloud->formatedDate()); ?></em>
									<iframe width="100%" height="166" scrolling="no" src="<?php echo htmlspecialchars($soundcloud->urlSoundcloud());?>" frameborder="0" allowfullscreen></iframe>
									<?php
									if($connecte) {
										echo '<a href=\'pageSoundcloudRemove.php?groupe='.$membre->id().'&soundcloud='.$soundcloud->id().'\'>Supprimer ce soundcloud</a>';
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

