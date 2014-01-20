<?php
	require 'InclusionCampus.class.php';
	$inclusionCampus = new InclusionCampus(0);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Contact</title>
		<?php $inclusionCampus->inclusionStyle(); ?>
	</head>
	
	<body>
		<div id="block_page">
		
			<?php $inclusionCampus->inclusionBanniere(); ?>
			
			<div id="corpsDeLaPage">
			
			<?php $inclusionCampus->inclusionMenuGauche(); ?>
			
			<div id="panneau_central" style="text-align:left;">

				<h1 style="text-align:center;">Contact</h1>
				
				<h2 class="titreBleu" style="text-align:left;" >Où se trouve notre local ?</h2>
					<section id="contact-gauche">
						<iframe  width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.fr/maps?f=d&amp;source=s_d&amp;saddr=Rue+du+G%C3%A9n%C3%A9ral+Leclerc&amp;daddr=Route+inconnue&amp;hl=fr&amp;geocode=Fe8J5wIdZAAhAA%3BFcYg5wIdbxkhAA&amp;aq=t&amp;sll=48.701342,2.167858&amp;sspn=0.004312,0.010568&amp;t=h&amp;mra=dme&amp;mrsp=1&amp;sz=17&amp;ie=UTF8&amp;ll=48.701342,2.167858&amp;spn=0.004312,0.010568&amp;output=embed"></iframe><br /><small><a href="https://maps.google.fr/maps?f=d&amp;source=embed&amp;saddr=Rue+du+G%C3%A9n%C3%A9ral+Leclerc&amp;daddr=Route+inconnue&amp;hl=fr&amp;geocode=Fe8J5wIdZAAhAA%3BFcYg5wIdbxkhAA&amp;aq=t&amp;sll=48.701342,2.167858&amp;sspn=0.004312,0.010568&amp;t=h&amp;mra=dme&amp;mrsp=1&amp;sz=17&amp;ie=UTF8&amp;ll=48.701342,2.167858&amp;spn=0.004312,0.010568" style="color:#0000FF;" target="blank">Agrandir le plan</a></small>
					</section>
					
					<section id="contact-centre">
						<a href="https://www.facebook.com/CampusEnMusique" ><span id='sp'><img src="Images/Menus/Facebook.jpg" alt="Facebook" ></span></a></br>
						<a href="https://twitter.com/CampusenMusique" ><span id='sp'><img src="Images/Menus/Twitter.jpg" alt="Twitter" ></span></a></br>
						<a href="http://www.youtube.com/channel/UCWd8myOWID6nqhoRWvxC9bg"><span id='sp'><img src="Images/Menus/YouTube.jpg" alt="Youtube" ></span></a></br>
						<a href="mailto:campus-en-musique.asso@u-psud.fr" ><span id='sp'><img src="Images/Menus/Email.png" alt="Email" ></span></a></br>
					</section>
					
					<section id="contact-droite">
						<ul>
							
							<li style="margin-top: 2%;">Suivez les actualités de Campus en musique sur Facebook </li></br>
							<li style="margin-top: 6%;">Ou Sur Twitter </li></br>
							<li style="margin-top: 8%;">Vous pouvez aussi decouvrir notre chaine Youtube </li> </br>
							<li style="margin-top: 9%;">Enfin voici l'adresse email officielle de Campus en Musique </li> </br>
						</ul>	
					</section>
				
				<!--<h2 class="titreBleu">Comment nous contactez ?</h2>-->
					
																		
					
			</div>
	
			<?php $inclusionCampus->inclusionMenuDroit(); ?>
			
			</div>
			
			<?php $inclusionCampus->inclusionFooter(); ?>
			
		</div>
	</body>
</html>