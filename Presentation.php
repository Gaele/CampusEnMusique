<?php
	require 'InclusionCampus.class.php';
	$inclusionCampus = new InclusionCampus(0);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Présentation</title>
		<?php $inclusionCampus->inclusionStyle(); ?>
	</head>
	
	<body>
		<div id="block_page">
		
			<?php $inclusionCampus->inclusionBanniere(); ?>
			
			<div id="corpsDeLaPage">
			
			<?php $inclusionCampus->inclusionMenuGauche(); ?>
			
			<div id="panneau_central" style="text-align:left;">
<!--				<h1>Animations</h1>
				<div class="centrer">
					Ce site est encore en developpement et cette section est vide pour le moment.<br/>
					Pour toute question, veuillez nous contacter par ce lien : <a href="mailto:campusenmusic@gmail.com" target="_blank">campusenmusic@gmail.com</a>
		
				</div>
-->
				<h1 style="text-align:center;">Présentation</h1>
				
				<h2 class="titreBleu">Qui sommes-nous ?</h2>
				<p>
					Campus en Musique est une association musicale étudiante de l'Université d'Orsay (Paris Sud 11),<br/>créée pour promouvoir l'activité musicale sur tous les supports.
				</p>
				<!--<p style="text-align:center;"><strong>*********************</strong></p>-->
				<h2 class="titreBleu">Que proposons-nous ?</h2>
					<h3 class="underline">Jam-sessions</h3>
					<p>
						Les jams-sessions sont des séances d'improvisation collective qui ont souvent lieu le midi dans le local de notre association.
					</p>
					<h3 class="underline">Location d'une salle</h3>
					<p>
						Une salle équipée d'amplis, d'une batterie, de câbles, d'une table de mixage et d'un clavier est mise à la disposition de nos membres 
						2 heures par semaine pour <strong>seulement 50 euros par trimestre et par groupe</strong>. Nous avons ainsi 12 groupes qui répètent de manière hebdomadaire.
						Nos groupes sont assez diversifiés (celtique, jazz, rock, improvisation libre) et nos niveaux hétérogènes. 
						En effet, certains de nos membres viennent du CFMI d'Orsay tandis que d'autres découvrent la musique avec nous, et la tranche d'âge 
						s'étend de la première année de licence à la dernière année de thèse.
						Les créneaux actuellement réservés sont à <a href="http://campusenmusiqueorsay.alwaysdata.net/Salle.php"  target="_blank">cette adresse</a>.
						Contactez <a href="mailto:campusenmusic@gmail.com" target="_blank">campusenmusic@gmail.com</a> pour poser vos questions et réserver un créneau.
					</p>
					<h3 class="underline">Ateliers Didactiques</h3>
					<p>
						Régulièrement, des ateliers sont organisés dans notre association. Ils ont pour but de compléter les formations musicales et d'approfondir
						la pratique instrumentale. Selon les années, ils ont pour thème le <strong>jazz</strong>, <strong>le jazz manouche</strong>, 
						la <strong>musique celtique</strong>, l'<strong>improvisation</strong>, la <strong>composition</strong>...
					</p>
					<h3 class="underline">Concerts et Représentations</h3>
					<p>
						Nous organisons des concerts dans les résidences et restaurants universitaires. A titre d'exemple :<br/>
						<strong>Haddock's Eyes</strong><br/>
						<a href="http://www.youtube.com/watch?v=EqzOOi0FPH0" target="_blank">http://www.youtube.com/watch?v=EqzOOi0FPH0</a><br/>
						<br/>
						<strong>Troub</strong>, qui a la particularité de faire danser les étudiants sur ses musiques celtiques.<br/>
						<a href="http://www.youtube.com/watch?v=sxpkTQgpY0w" target="_blank">http://www.youtube.com/watch?v=sxpkTQgpY0w</a><br/>
						<br/>
						<strong>Onion Union</strong> qui demande au public de donner un thème célèbre puis l'improvise et le modifie dans l'instant.<br/>
						<a href="http://www.youtube.com/watch?v=HbbT5j57xxY" target="_blank">http://www.youtube.com/watch?v=HbbT5j57xxY</a><br/>
						<br/>
						<strong>O-Liostère</strong> (concert à l'OPA Paris-Bastille fin Mars produit par Campus en Musique)<br/>
						<a href="http://vimeo.com/34201548" target="_blank">http://vimeo.com/34201548</a><br/>
						<br/>
						<strong>Celtic Frog</strong>
						<a href="http://celtic-frog.super-h.fr/Enregistrements.htm" target="_blank">http://celtic-frog.super-h.fr/Enregistrements.htm</a><br/>
						<br/>
						Et beaucoup d'autres...
					</p>
				<!--<p style="text-align:center;"><strong>*********************</strong></p>-->
				<h2 class="titreBleu">Vous voulez participer ?</h2>
					<h3 class="underline">Membres</h3>
					<p>	
						Nous accueillons à bras ouvert toute personne désireuse de réaliser des projets liés à la musique,
						qu'il s'agisse d'organiser des concerts, de bricoler sur des instruments, de designer des affiches ou de lancer des projets
						inédits ! <strong>Il y a tant de possibilités !</strong> Vous trouverez assurément un domaine qui vous plait.
						Mener de tels projets en équipe est une <strong>réelle expérience</strong> que l'on n'oublie pas.
					</p>
					<h3 class="underline">Partenaires</h3>
					<p>
						Nous cherchons des <strong>scènes de concerts</strong> pour y faire jouer nos groupes. Si vous disposez d'une scène et que cette proposition vous intéresse,
						contactez-nous. Nous engagerons peut-être des projets communs.
					</p>
				<h2 class="titreBleu">Contact</h2>
					<p>
						campusenmusic@gmail.com<br/>
						06-06-40-93-26 (Vincent)
					</p>
			</div>
	
			<?php $inclusionCampus->inclusionMenuDroit(); ?>
			
			</div>
			
			<?php $inclusionCampus->inclusionFooter(); ?>
			
		</div>
	</body>
</html>