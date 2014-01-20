<?php
	class BlogCommentairesAdminVue {
	
	public static function affiche($billet, $commentaires, $nbPagesAffiche, $nbPages, $page, $url) {
	
	// verification des donnees
	if(!($billet instanceof Billet) || !is_array($commentaires) || !is_numeric($page) || !is_string($url) ||
		!is_numeric($nbPagesAffiche) || !is_numeric($nbPages)) {
		echo 'Gros probleme';
		return;
	}
	
	require_once(dirname(dirname(dirname(__FILE__))).'/InclusionCampus.class.php');
	$inclusionCampus = new InclusionCampus(2);
?>

<!DOCTYPE html>
<html>
	<header>
		<title>Commentaires</title>
		<?php $inclusionCampus->inclusionStyle(); ?>
		
	</header>

	<body>
		<div id="block_page">
		
			<?php $inclusionCampus->inclusionBanniere(); ?>
			
			<div id="corpsDeLaPage">
				<?php $inclusionCampus->inclusionMenuGauche(); ?>
			
			<div id="panneau_central">
				<h1>Commentaires</h1>
				<p><a href="BlogBilletAdmin.php">Retour a la liste des sujets</a></p>
				<?php VueBlog::afficheBillet($billet, false);?>
			
				<div class='commentaire'>
					<!-- <h2>Commentaires</h2> -->
				</div>
				<a href='BlogCommentairesAjoutAdmin.php?billet=<?php echo $_GET['billet']; ?>'>Ajouter un commentaire</a>
				<br/>
				<?php
					if(empty($commentaires)) { // si il n'y a pas de commentaires
						VueBlog::afficheAucunCommentaire();
					} else {
						foreach($commentaires as $key => $commentaire) {
							VueBlogAdmin::afficheCommentaire($commentaire);
						}
						PageGenerator::echoLiensVersPagesSuivantes($nbPagesAffiche, $nbPages, $page, $url);
					}
				
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

