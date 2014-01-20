<?php
	require 'InclusionCampus.class.php';
	$inclusionCampus = new InclusionCampus(0);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Pr�sentation</title>
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
				<h1 style="text-align:center;">Pr�sentation</h1>
				
				<h2 class="titreBleu">Qui sommes-nous ?</h2>
				<p>
					Campus en Musique est une association musicale �tudiante de l'Universit� d'Orsay (Paris Sud 11),<br/>cr��e pour promouvoir l'activit� musicale sur tous les supports.
				</p>
				<!--<p style="text-align:center;"><strong>*********************</strong></p>-->
				<h2 class="titreBleu">Que proposons-nous ?</h2>
					<h3 class="underline">Jam-sessions</h3>
					<p>
						Les jams-sessions sont des s�ances d'improvisation collective qui ont souvent lieu le midi dans le local de notre association.
					</p>
					<h3 class="underline">Location d'une salle</h3>
					<p>
						Une salle �quip�e d'amplis, d'une batterie, de c�bles, d'une table de mixage et d'un clavier est mise � la disposition de nos membres 
						2 heures par semaine pour <strong>seulement 50 euros par trimestre et par groupe</strong>. Nous avons ainsi 12 groupes qui r�p�tent de mani�re hebdomadaire.
						Nos groupes sont assez diversifi�s (celtique, jazz, rock, improvisation libre) et nos niveaux h�t�rog�nes. 
						En effet, certains de nos membres viennent du CFMI d'Orsay tandis que d'autres d�couvrent la musique avec nous, et la tranche d'�ge 
						s'�tend de la premi�re ann�e de licence � la derni�re ann�e de th�se.
						Les cr�neaux actuellement r�serv�s sont � <a href="http://campusenmusiqueorsay.alwaysdata.net/Salle.php"  target="_blank">cette adresse</a>.
						Contactez <a href="mailto:campusenmusic@gmail.com" target="_blank">campusenmusic@gmail.com</a> pour poser vos questions et r�server un cr�neau.
					</p>
					<h3 class="underline">Ateliers Didactiques</h3>
					<p>
						R�guli�rement, des ateliers sont organis�s dans notre association. Ils ont pour but de compl�ter les formations musicales et d'approfondir
						la pratique instrumentale. Selon les ann�es, ils ont pour th�me le <strong>jazz</strong>, <strong>le jazz manouche</strong>, 
						la <strong>musique celtique</strong>, l'<strong>improvisation</strong>, la <strong>composition</strong>...
					</p>
					<h3 class="underline">Concerts et Repr�sentations</h3>
					<p>
						Nous organisons des concerts dans les r�sidences et restaurants universitaires. A titre d'exemple :<br/>
						<strong>Haddock's Eyes</strong><br/>
						<a href="http://www.youtube.com/watch?v=EqzOOi0FPH0" target="_blank">http://www.youtube.com/watch?v=EqzOOi0FPH0</a><br/>
						<br/>
						<strong>Troub</strong>, qui a la particularit� de faire danser les �tudiants sur ses musiques celtiques.<br/>
						<a href="http://www.youtube.com/watch?v=sxpkTQgpY0w" target="_blank">http://www.youtube.com/watch?v=sxpkTQgpY0w</a><br/>
						<br/>
						<strong>Onion Union</strong> qui demande au public de donner un th�me c�l�bre puis l'improvise et le modifie dans l'instant.<br/>
						<a href="http://www.youtube.com/watch?v=HbbT5j57xxY" target="_blank">http://www.youtube.com/watch?v=HbbT5j57xxY</a><br/>
						<br/>
						<strong>O-Liost�re</strong> (concert � l'OPA Paris-Bastille fin Mars produit par Campus en Musique)<br/>
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
						Nous accueillons � bras ouvert toute personne d�sireuse de r�aliser des projets li�s � la musique,
						qu'il s'agisse d'organiser des concerts, de bricoler sur des instruments, de designer des affiches ou de lancer des projets
						in�dits ! <strong>Il y a tant de possibilit�s !</strong> Vous trouverez assur�ment un domaine qui vous plait.
						Mener de tels projets en �quipe est une <strong>r�elle exp�rience</strong> que l'on n'oublie pas.
					</p>
					<h3 class="underline">Partenaires</h3>
					<p>
						Nous cherchons des <strong>sc�nes de concerts</strong> pour y faire jouer nos groupes. Si vous disposez d'une sc�ne et que cette proposition vous int�resse,
						contactez-nous. Nous engagerons peut-�tre des projets communs.
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