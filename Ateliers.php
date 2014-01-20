<?php
	require 'InclusionCampus.class.php';
	$inclusionCampus = new InclusionCampus(0);

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
				<h1>Ateliers</h1>
				Notre association propose plusieurs ateliers anim�s par des �tudiants, pour des �tudiants.<br/>
				Cette ann�e, ils sont au nombre de 3 :<br/>
					
				<h2><a href="#">Atelier Technical-Dreams</a></h2>
				<p>
					Donnant priorit� � la creation, cet atelier se concentre sur la composition, l'orchestration et l'utilisation
					de techniques informatiques.
				</p>
				
				<h2><a href="#">Atelier de musique celtique</a></h2>
				<p>
					A la fois tres rythmique et tres m�lodieuse, souvent simple mais toujours efficace,<br/> la musique celtique a su traverser les �ges sans prendre une ride.<br/>
					Dirig� par le fondateur du groupe "Troub", l'un des plus entendu au sein de l'universite, cet atelier part � la d�couverte de cette culture souvent trop peu connue, tr�s proche des danses traditionnelles et de la magie de Tolkien.
				</p>
				
				<!--
				<div class="audio-image">
					<figcaption>Scarborough</figcaption>
					<img src="Images/user_dev/lyre.gif"/>
					<audio src="Audio/scarborough.mp3" controls></audio>
				</div>
				-->
				
				<h2><a href="#">Atelier Jazz</a></h2>
				
				<p>
					Ancr�e dans la musique populaire du 20eme siecle, le jazz a toujours beaucoup � nous apprendre.<br/>
					Cet atelier s'interessera � la construction des accords et leur enchainements � travers des morceaux reconnus ainsi que des improvisations.
					Un atelier � ne pas manquer !
				</p>
			</div>
			
			<?php $inclusionCampus->inclusionMenuDroit(); ?>
			
			</div>
			
			<?php $inclusionCampus->inclusionFooter(); ?>
			
		</div>
	</body>
</html>