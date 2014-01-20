<?php
class PageGroupeModificationVue {

	public static function afficher(Membres $membre, PageGroupe $page, $petiteErreur) {

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
				<h1><?php echo htmlspecialchars($membre->pseudo()); ?> Modifications</h1>
				
				<?php if($petiteErreur != '') {echo '<span class=\'erreur\'>'.$petiteErreur.'</span>'; }?>
				
				<form action="PageGroupeModification.php?groupe=<?php echo $membre->id(); ?>" method="post">
					<label><strong>Url de l'Image du groupe</strong></label><br/>
					<input type='url' name='image' value='<?php echo htmlspecialchars(trim($page->imagePresentation())); ?>'  style='width:80%'/><br/>
					
					<em style='color:rgb(52, 183, 118);'>
					(Pour ajouter une photo,
					Déposez-la sur un site puis faites un clique droit sur l'image. 
					Choisissez l'option "Copier l'url de l'image" 
					Enfin, revenez sur cette page, faites un clique droit dans la zone url ci-dessus et choisissez 'coller')
					</em>
					
					<br/><br/>
					
					<label><strong>Description / Historique</strong></label>
					<textArea name='description' rows='10'><?php echo htmlspecialchars(trim($page->historique())); ?></textArea>
					
					<label><strong>Projets / Concerts</strong></label>
					<textArea name='projets' rows='8'><?php echo htmlspecialchars(trim($page->projets())); ?></textArea>
					
					<label><strong>Mail</strong></label><br/>
					<input type='email' name='email' value='<?php echo htmlspecialchars(trim($page->mail())); ?>'  style='width:30%'/><br/>
				
					<label><strong>Site</strong></label><br/>
					<input type='url' name='url' value='<?php echo htmlspecialchars(trim($page->site())); ?>'  style='width:30%'/><br/>
				
					<label><strong>Telephone</strong></label><br/>
					<input type='tel' name='tel' value='<?php echo htmlspecialchars(trim($page->telephone())); ?>' style='width:30%'/>
					<br/><br/>
					<input type='submit' value='Enregistrer les modifications'/>
				</form>
				
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
