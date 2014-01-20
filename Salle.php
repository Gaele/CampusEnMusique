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
					Nous avons la chance de posséder un local équipé au batiment 334.
					Cette salle peut être louée pendant 2h par semaine, moyennant un chèque de caution de 300 Euros (en cas de vol), ainsi qu'un
					total de 50 Euros par groupe, pour la participation à l'usure des locaux et du matériel.
				</p>
				
				<p>
					Pour réserver un creneau, ou pour poser vos questions, nous vous encourageons à nous rencontrer au 334,<br/>
					à poser votre question sur le forum, ou à nous écrire à l'adresse : <a href="mailto:campusenmusic@gmail.com" target="_blank">campusenmusic@gmail.com</a>
				</p>
				
				<p>
					Pour avoir accès au code de la salle, il faut être inscrit, et avoir donné un chèque de caution à Campus En Musique.<br />
					Pour 2.50€/h seulement, vous pouvez réserver et disposer de la salle pour vous seul.
				</p>
				
				<iframe src="https://www.google.com/calendar/embed?mode=WEEK&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=q5vh5u2jdqr1ujlkubpjb7fd0s%40group.calendar.google.com&amp;color=%23BE6D00&amp;src=campusenmusic%40gmail.com&amp;color=%234A716C&amp;ctz=Europe%2FParis" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
				
			</div>
			
			<?php $inclusionCampus->inclusionMenuDroit(); ?>
			
			</div>
			
			<?php $inclusionCampus->inclusionFooter(); ?>
			
		</div>
	</body>
</html>