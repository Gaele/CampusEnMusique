<?php
class PagePersoVue {

	public static function affiche(Membres $membre, PageGroupe $page, $images, $videos, $connecte, $soundclouds) {

	if(!is_numeric($images)) {
		trigger_error('nombre d\'images non numerique', E_USER_WARNING);
		return;
	} else if(!is_numeric($videos)) {
		trigger_error('nombre d\'images non numerique', E_USER_WARNING);
		return;
	}
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
				<h1><?php echo htmlspecialchars($membre->pseudo()); ?></h1>
				
				<div class='pagePerso'>
				
				<?php
					if($connecte) {
						echo '<h2><a href=\'PageGroupeModification.php?groupe='.$membre->id().'\' style=\'color:red;border:1px solid red;\'>Modifier les informations de cette page</a></h2>';
					}
				?>
					
					<?php
					if(trim(htmlspecialchars($page->imagePresentation())) != '')
						$src = htmlspecialchars($page->imagePresentation());
					else
						$src = '../Images/Membres/defaultImage.png';
					?>
				
					<div class='imagePresentation'>
					<img src='<?php echo $src; ?>' alt='Image du groupe' title='Image du groupe' style='max-width:99%;height:300px'/>
					</div>
				
				
					<?php
					if(trim(htmlspecialchars($page->historique())) == '') {
						$tmp = '<em>(Aucun historique de groupe)</em>';
					} else {
						$tmp = nl2br(htmlspecialchars($page->historique()));
					}
					?>
					<section class='billet'>
						<h3>Description / Historique</h3>
						<p>
							<?php echo $tmp; ?>
						</p>
					</section>
					
					<?php
					if(trim(htmlspecialchars($page->projets())) == '') {
						$tmp = '<em>(Aucun projet pour l\'instant)</em>';
					} else {
						$tmp = nl2br(htmlspecialchars($page->projets()));
					}
					?>
					<section  class='billet'>
						<h3>Projets / Concerts</h3>
						<p>
							<?php echo $tmp; ?>
						</p>
					</section>
					
					<?php
					if($images != 0 || $connecte) {
						?>
						<h3>
							<a href="<?php echo '../Membres/pageImage.php?groupe='.$membre->id(); ?>">Voir notre galerie d'images</a>
						</h3>
						<?php
					}
					
					if($videos != 0 || $connecte) {
						?>
						<h3>
							<a href="<?php echo '../Membres/pageVideo.php?groupe='.$membre->id(); ?>">Voir notre galerie de videos</a>
						</h3>
						<?php
					}
					if($soundclouds != 0 || $connecte) {
						?>
						<h3>
							<a href="<?php echo '../Membres/pageSoundcloud.php?groupe='.$membre->id(); ?>">Voir notre galerie de Soundcloud</a>
						</h3>
						<?php
					}
					//verifier que rien n'est affiche en cas de problem
					if(trim(htmlspecialchars($page->mail())) != '' || trim(htmlspecialchars($page->site())) != '' || trim(htmlspecialchars($page->telephone())) != '') {
					?>
					<section class='billet'>
						<h3>Contact</h3>
						<p>
							<?php
							if(trim(htmlspecialchars($page->mail())) != '') {
								echo '<strong>mail : </strong><a href="mailto:'.nl2br(htmlspecialchars($page->mail())).'" target="_blank">'.nl2br(htmlspecialchars($page->mail())).'</a><br/>';
							}
							if(trim(htmlspecialchars($page->site())) != '') {
								echo '<strong>site : </strong><a href=\''.nl2br(htmlspecialchars($page->site())).'\' target="_blank">'.nl2br(htmlspecialchars($page->site())).'</a><br/>';
							}
							if(trim(htmlspecialchars($page->telephone())) != '') {
								echo '<strong>téléphone : </strong>'.nl2br(htmlspecialchars($page->telephone())).'<br/>';
							}
							?>
						</p>
					</section>
					<?php
					}
					if($connecte) {
						?>
						<h2>
							<a href="<?php echo '../Groupes/pagePerso.php?groupe='.$membre->id()."&supprime=1"; ?>" style="color:red;border:1px solid red;">Supprimer le groupe</a>
						</h2>
						<?php
					}
					?>
					
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