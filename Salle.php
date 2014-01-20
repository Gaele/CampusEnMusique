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
				<h1>Salle</h1>
				
				<p>
					Nous avons la chance de poss�der un local �quip� au batiment 334.
					Cette salle peut �tre lou�e pendant 2h par semaine, moyennant un ch�que de caution de 300 Euros (en cas de vol), ainsi qu'un
					total de 50 Euros par groupe, pour la participation � l'usure des locaux et du mat�riel.
				</p>
				
				<p>
					Pour r�server un creneau, ou pour poser vos questions, nous vous encourageons � nous rencontrer au 334,<br/>
					� poser votre question sur le forum, ou � nous �crire � l'adresse : <a href="mailto:campusenmusic@gmail.com" target="_blank">campusenmusic@gmail.com</a>
				</p>
				
				<p>
					Pour avoir acc�s au code de la salle, il faut �tre inscrit, et avoir donn� un ch�que de caution � Campus En Musique.<br />
					Pour 2.50�/h seulement, vous pouvez r�server et disposer de la salle pour vous seul.
				</p>
				
				<iframe src="https://www.google.com/calendar/embed?mode=WEEK&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=q5vh5u2jdqr1ujlkubpjb7fd0s%40group.calendar.google.com&amp;color=%23BE6D00&amp;src=campusenmusic%40gmail.com&amp;color=%234A716C&amp;ctz=Europe%2FParis" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
				
			</div>
			
			<?php $inclusionCampus->inclusionMenuDroit(); ?>
			
			</div>
			
			<?php $inclusionCampus->inclusionFooter(); ?>
			
		</div>
	</body>
</html>